<?php
namespace taquilla\modules\controllers;

use common\models\Boleto;
use common\models\BoletoAsiento;
use common\models\HorarioFuncion;
use common\models\Pago;
use common\models\SalaAsientos;
use taquilla\controllers\BaseAuthController;
use Yii;

class BoletosController extends BaseAuthController
{
    public $modelClass = 'common\models\Pago';

    private $paymentTypes = ['taquilla'];

    public function actions()
    {
        return [
            'index',
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    public function actionPagar($horarioid)
    {
        $faceUserID     = 8;
        $userID         = Yii::$app->user->id;
        $salaAsientosID = Yii::$app->request->getBodyParam('asientos', []);
        // $precios        = Yii::$app->request->getBodyParam('precios', []);
        $type = Yii::$app->request->getBodyParam('type', false);

        if (
            // !is_array($precios) ||
            // empty($precios) ||
            empty($salaAsientosID)
        ) {
            throw new \yii\web\HttpException(400, 'Hay un error con los datos de la llamada');
        }

        if ($type == false || !in_array($type, $this->paymentTypes)) {
            throw new \yii\web\HttpException(400, 'Tipo de pago no soportado');
        }

        $horarioFuncion = HorarioFuncion::findOne($horarioid);
        if (is_null($horarioFuncion)) {
            throw new \yii\web\HttpException(404, 'Horario no encontrado');
        }

        // revisar que todos los asientos estén disponibles en ese horario
        $comprados = BoletoAsiento::find()
            ->innerJoin(['b' => 'boleto'], 'b.id = boleto_asiento.boleto_id')
            ->innerJoin(['hf' => 'horario_funcion'], 'hf.id = b.horario_funcion_id')
            ->where(['in', 'boleto_asiento.sala_asiento_id', $salaAsientosID])
            ->andWhere(['hf.id' => $horarioid])
            ->count();

        // revisar que esos asientos pertenezcan a la sala
        $salaAsientos = SalaAsientos::find()
            ->innerJoin(['hf' => 'horario_funcion'], 'hf.sala_id = sala_asientos.sala_id')
            ->where(['in', 'sala_asientos.id', $salaAsientosID])
            ->andWhere(['hf.id' => $horarioid])
            ->all();

        // revisar que esos asientos pertenezcan a la sala
        /*$precioHorarios = HorarioPrecio::find()
        ->alias('hp')
        ->where(['in', 'hp.precio_id', $precios])
        ->andWhere(['hp.horario_id' => $horarioid])
        ->all();*/

        $NSalaAsientos = count($salaAsientosID);
        if ($comprados > 0 || empty($salaAsientos) || count($salaAsientos) != $NSalaAsientos || $NSalaAsientos > Yii::$app->params['maxBoletos']) {
            throw new \yii\web\HttpException(409, 'Uno o mas asientos no están disponibles');
        }
        if (empty($precioHorarios) || count($precioHorarios) !== count(array_unique($precios))) {
            throw new \yii\web\HttpException(422, 'Error algún precio no es valido');
        }

        /*foreach ($precioHorarios as $precioHr) {
        foreach ($precios as &$p) {
        if (!($p instanceof HorarioPrecio) && $p == $precioHr->precio->id) {
        $p = $precioHr;
        }
        }
        }
        unset($p);*/

        $txn = Yii::$app->db->beginTransaction();

        try {

            $boleto = new Boleto();

            $boleto->face_user_id       = $faceUserID;
            $boleto->horario_funcion_id = $horarioFuncion->id;
            $boleto->reclamado          = 0;
            $boleto->user_id            = $userID;
            $boleto->tipo_pago          = $type;

            if (!$boleto->save()) {
                throw new \yii\web\HttpException(400, 'Hubo un error al guardar tu boleto');
            }

            foreach ($salaAsientos as $salaAsiento) {
                $boletoAsiento                  = new BoletoAsiento();
                $boletoAsiento->sala_asiento_id = $salaAsiento->id;
                $boletoAsiento->boleto_id       = $boleto->id;
                if (!$boletoAsiento->save()) {
                    throw new \yii\web\HttpException(400, 'Hubo un error al apartar tus asientos');
                }
            }

            /*foreach ($precioHorarios as $precioHr) {
            $boletoPrecio            = new BoletoPrecio();
            $boletoPrecio->precio_id = $precioHr->precio->id;
            $boletoPrecio->boleto_id = $boleto->id;
            $boletoPrecio->precio    = ($precioHr->usar_especial == 1) ? $precioHr->precio->especial : $precioHr->precio->default;
            if (!$boletoPrecio->save()) {
            throw new \yii\web\HttpException(400, 'Hubo un error al apartar tus asientos');
            }
            }*/

            $boleto->setQR();
            if (!$boleto->save()) {
                throw new \yii\web\HttpException(400, 'Hubo un error al guardar tu boleto');
            }

            switch ($type) {
                case 'taquilla':
                    $pago = new Pago();

                    $pago->face_user_id    = $faceUserID;
                    $pago->create_time     = date('Y-m-d H:i');
                    $pago->id_pago_externo = '' . $userID;
                    $pago->intent          = 'sale';
                    $pago->state           = 'approved';
                    $pago->tipo_pago       = 'taquilla';

                    if (!$pago->save()) {
                        throw new \yii\web\HttpException(400, 'Hubo un error al procesar tu Pago');
                    }
                    break;

                default:
                    throw new \yii\web\HttpException(422, 'Tipo de pago no valido');
                    break;
            }

            $boleto->id_pago = $pago->id;
            if (!$boleto->save()) {
                throw new \yii\web\HttpException(400, 'Hubo un error al procesar tu boleto');
            }

            $txn->commit();

            return new \api\models\BoletoRest($boleto->attributes);
        } catch (\Exception $e) {
            $txn->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $txn->rollBack();
            throw $e;
        }
    }
}
