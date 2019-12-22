<?php

namespace taquilla\modules\controllers;

use common\models\Apartado;
use common\models\ApartadoAsiento;
use common\models\HorarioFuncion;
use common\models\HorarioPrecio;
use common\models\Permiso;
use common\models\SalaAsientos;
use taquilla\controllers\BaseAuthController;
use Yii;
use yii\web\HttpException;

class ApartadosController extends BaseAuthController
{
    public $modelClass = 'common\models\Apartado';

    private $_paymentTypes = ['taquilla'];

    public function actions()
    {
        return [
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    public function actionListarApartados()
    {
        $nombre = Yii::$app->request->getQueryParam('nombre', null);

        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_APARTAR)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }

        $query = Apartado::find()
            ->innerJoin(['hf' => 'horario_funcion'], 'hf.id = apartado.horario_funcion_id')
            ->andWhere('hf.fecha BETWEEN NOW() AND (NOW() + INTERVAL 2 DAY)')
            ->andFilterWhere(['nombre' => $nombre])
            ->orderBy('hf.fecha DESC');

        return $query->all();

    }

    public function actionApartar($horarioid)
    {
        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_NUEVO_APARTADO)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }

        $nombre         = Yii::$app->request->getBodyParam('nombre', false);
        $salaAsientosID = Yii::$app->request->getBodyParam('asientos', []);
        $precios        = Yii::$app->request->getBodyParam('precios', []);

        if (!is_array($precios) || empty($precios) || empty($salaAsientosID)) {
            throw new HttpException(400, 'Hay un error con los datos de la llamada');
        }

        if ($nombre == false || $nombre == '') {
            throw new HttpException(422, 'Nombre no valido');
        }

        $horarioFuncion = HorarioFuncion::findOne($horarioid);
        if (is_null($horarioFuncion)) {
            throw new HttpException(422, 'Horario no encontrado');
        }

        // revisar que todos los asientos estén disponibles en ese horario
        $comprados = HorarioFuncion::find()->alias('hf')
            ->leftJoin(['aa' => 'apartado_asiento'], 'hf.id = aa.horario_funcion_id')
            ->leftJoin(['ba' => 'boleto_asiento'], 'hf.id = ba.horario_funcion_id')
            ->where(['OR', ['in', 'aa.sala_asiento_id', $salaAsientosID], ['in', 'ba.sala_asiento_id', $salaAsientosID]])
            ->andWhere(['hf.id' => $horarioid])
            ->count();

        // revisar que esos asientos pertenezcan a la sala
        $salaAsientos = SalaAsientos::find()
            ->innerJoin(['hf' => 'horario_funcion'], 'hf.sala_id = sala_asientos.sala_id')
            ->where(['in', 'sala_asientos.id', $salaAsientosID])
            ->andWhere(['hf.id' => $horarioid])
            ->all();

        $precioHorarios = HorarioPrecio::find()
            ->alias('hp')
            ->where(['in', 'hp.precio_id', $precios])
            ->andWhere(['hp.horario_id' => $horarioid])
            ->all();

        $NSalaAsientos = count($salaAsientosID);
        if ($comprados > 0 || empty($salaAsientos) || count($salaAsientos) != $NSalaAsientos || $NSalaAsientos > Yii::$app->params['maxBoletos']) {
            throw new HttpException(409, 'Uno o mas asientos no están disponibles');
        }
        if (empty($precioHorarios) || count($precioHorarios) !== count(array_unique($precios))) {
            throw new HttpException(422, 'Error algún precio no es valido');
        }

        foreach ($precioHorarios as $precioHr) {
            foreach ($precios as &$p) {
                if (!($p instanceof HorarioPrecio) && $p == $precioHr->precio->id) {
                    $p = $precioHr;
                }
            }
        }
        unset($p);

        $txn = Yii::$app->db->beginTransaction();

        try {

            $apartado = new Apartado();

            $apartado->nombre             = $nombre;
            $apartado->horario_funcion_id = $horarioFuncion->id;

            if (!$apartado->save()) {
                throw new HttpException(400, 'Hubo un error al guardar tu apartado');
            }

            foreach ($salaAsientos as $idx => $salaAsiento) {
                $boletoAsiento                     = new ApartadoAsiento();
                $boletoAsiento->sala_asiento_id    = $salaAsiento->id;
                $boletoAsiento->horario_funcion_id = $apartado->horario_funcion_id;
                $boletoAsiento->apartado_id        = $apartado->id;
                $boletoAsiento->precio_id          = $precios[$idx]->precio->id;
                $boletoAsiento->precio             = ($precios[$idx]->usar_especial == 1) ? $precios[$idx]->precio->especial : $precios[$idx]->precio->default;
                if (!$boletoAsiento->save()) {
                    throw new HttpException(400, 'Hubo un error al apartar tus asientos');
                }
            }

            $txn->commit();

            return $apartado;
        } catch (\Exception $e) {
            $txn->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $txn->rollBack();
            throw $e;
        }
    }
}
