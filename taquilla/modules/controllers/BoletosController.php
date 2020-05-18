<?php

namespace taquilla\modules\controllers;

use common\models\Boleto;
use common\models\BoletoAsiento;
use common\models\Cancelacion;
use common\models\FaceUser;
use common\models\HorarioFuncion;
use common\models\HorarioPrecio;
use common\models\Pago;
use common\models\Permiso;
use common\models\SalaAsientos;
use common\models\User;
use taquilla\controllers\BaseAuthController;
use Yii;
use yii\web\HttpException;

class BoletosController extends BaseAuthController
{
    public $modelClass = 'common\models\Pago';

    private $_paymentTypes = ['taquilla'];

    public function actions()
    {
        return [
            'search',
            'pagar',
            'cancelar',
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    public function actionCode($codigoBoleto)
    {
        //$codigoBoleto = Yii::$app->request->getQueryParam('codigoBoleto', null);

        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_REIMPRESION)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }

        $query = \api\models\BoletoRest::find()
            ->innerJoin(['fu' => 'face_user'], 'fu.id = boleto.face_user_id')
            ->innerJoin(['hf' => 'horario_funcion'], 'hf.id = boleto.horario_funcion_id');

        if (empty($codigoBoleto)) {
            $query->where(['boleto.user_id' => Yii::$app->user->id])
                ->andWhere('boleto.created_at BETWEEN (NOW() - INTERVAL 1 DAY) AND (NOW() + INTERVAL 1 DAY)')
                ->orderBy('boleto.created_at DESC');
        } else {
            $query->where(
                [
                    'boleto.id' => $codigoBoleto,
                ]
            );
        }

        $query->andWhere(['boleto.reclamado' => 0]);

        return $query->all();

    }

    public function actionSearch()
    {
        $email = Yii::$app->request->getQueryParam('email', null);
        $fecha = Yii::$app->request->getQueryParam('fecha', date('Y-m-d'));

        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_REIMPRESION)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }
        $date = \DateTime::createFromFormat('Y-m-d', $fecha);
        $date->setTime(0, 0);

        $today = new \DateTime();
        $today->setTime(0, 0);

        if ($date < $today) {
            throw new HttpException(400, 'Esta fecha es anterior al dia de hoy');
        }

        $query = \api\models\BoletoRest::find()
            ->innerJoin(['fu' => 'face_user'], 'fu.id = boleto.face_user_id')
            ->innerJoin(['hf' => 'horario_funcion'], 'hf.id = boleto.horario_funcion_id');

        if (empty($email)) {
            $query->where(['boleto.user_id' => Yii::$app->user->id])
                ->andWhere('boleto.created_at BETWEEN (NOW() - INTERVAL 1 DAY) AND (NOW() + INTERVAL 1 DAY)')
                ->orderBy('boleto.created_at DESC')
                ->limit(10);
        } else {
            $query->where(
                [
                    'fu.email' => $email,
                    'fu.status' => FaceUser::STATUS_ACTIVE,
                ]
            )
                ->andWhere('DATE(hf.fecha) = DATE("' . $date->format('Y-m-d') . '")');
        }

        $query->andWhere(['boleto.reclamado' => 0]);

        return $query->all();
    }

    public function actionReimpresion($id)
    {
        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_REIMPRESION)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }
        $data = \api\models\BoletoRest::find()
            ->innerJoin(['hf' => 'horario_funcion'], 'hf.id = boleto.horario_funcion_id')
            ->innerJoin(['fu' => 'face_user'], 'fu.id = boleto.face_user_id')
            ->where(
                [
                    'boleto.hash' => $id,
                    'boleto.reclamado' => 0,
                    'fu.status' => FaceUser::STATUS_ACTIVE,
                ]
            )
            ->andWhere('DATE(hf.fecha) >= DATE(NOW())')
            ->one();

        if ($data == null) {
            throw new HttpException(404, 'Este boleto no existe');
            return false;
        } else if ($data->reimpreso == 1) {
            throw new HttpException(404, 'Este boleto no se puede reimprimir');
        }

        $data->reimpreso = 1;

        if (!$data->save()) {
            throw new HttpException(404, 'Error al calcular reimpresion');
        }

        return $data;
    }

    /* Boleto de la app */
    public function actionValidarBoleto($id)
    {
        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_VERIFICACION)) {
            // throw new HttpException(403, "No tienes los permisos necesarios");
        }
        $data = \api\models\BoletoRest::find()
            ->innerJoin(['hf' => 'horario_funcion'], 'hf.id = boleto.horario_funcion_id')
            ->innerJoin(['fu' => 'face_user'], 'fu.id = boleto.face_user_id')
            ->where(
                [
                    'boleto.hash' => $id,
                ]
            )
            ->andWhere('DATE(hf.fecha) >= DATE(NOW())')
            ->one();

        if ($data == null) {
            throw new HttpException(402, 'Este boleto no existe o ya no es accesible');
            return false;
        } else if ($data->reclamado == 1) {
            throw new HttpException(410, 'Este boleto ya fue reclamado');
            return false;
        }

        $data->reclamado = 1;

        if (!$data->save()) {
            throw new HttpException(400, 'Error al validar boleto');
        }
        Yii::$app->response->statusCode = 202;
        return $data;
    }

    public function actionCancelar($boletoAsientoId, $deleteAll)
    {

        $user = Yii::$app->request->post('user', null);
        $pass = Yii::$app->request->post('pass', null);
        $motivo = Yii::$app->request->post('motivo', null);
        /*CHECK IF USER CAN CANCEL */


        $userModel = User::findByUsername($user);


        if (empty($userModel)) {
            throw new HttpException(403, "Credenciales incorrectas");
        }

        if (!$userModel->validatePassword($pass)) {
            throw new HttpException(403, "Credenciales incorrectas");
        }

        if ($userModel->hasPermission(Permiso::ACCESS_CANCELAR)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }


        //this code is for cancelation with who the ticket its over!
        $boleto         = BoletoAsiento::find()->where(['=', 'id', $boletoAsientoId])->one();
        $funcionId      = Boleto::find()->where(['=', 'id', $boleto->boleto_id])->select('horario_funcion_id')->one();
        $detalleFuncion = HorarioFuncion::find()->where(['=', 'id', $funcionId->horario_funcion_id])->one();
        $asiento        = SalaAsientos::find()->where(['=', 'id', $boleto->sala_asiento_id])->one();

        $cancelacionModel = new Cancelacion();

        $cancelacionModel->fechaCancelacion = date('Y/m/d h:i:sa');
        $cancelacionModel->nombreUsuario    = $user;
        $cancelacionModel->pelicula         = $detalleFuncion->pelicula->nombre;
        $cancelacionModel->funcionFecha     = $detalleFuncion->fecha;
        $cancelacionModel->funcionHora      = $detalleFuncion->hora;
        $cancelacionModel->sala             = $detalleFuncion->sala->nombre;
        $cancelacionModel->asiento          = $asiento->fila . $asiento->numero;
        $cancelacionModel->codigoBoleto     = $boleto->id . $asiento->fila . $asiento->numero;
        $cancelacionModel->motivo           = $motivo;

        //start deleting a sale
        $txn = Yii::$app->db->beginTransaction();
        try {

            //delete from boleto
            $boletoId = BoletoAsiento::find()->where(['=', 'id', $boletoAsientoId])->select('boleto_id')->one();
            //delete from pago
            $pagoId = Boleto::find()->where(['=', 'id', $boletoId->boleto_id])->select('id_pago')->one();

            //Delete from boleto_asiento
            \Yii::$app->db
                ->createCommand()
                ->delete('boleto_asiento', ['id' => $boletoAsientoId])
                ->execute();

            //If the sale only have once ticket delete the total sale!
            if ($deleteAll) {

                \Yii::$app->db
                    ->createCommand()
                    ->delete('boleto', ['id' => $boletoId->boleto_id])
                    ->execute();

                \Yii::$app->db
                    ->createCommand()
                    ->delete('pago', ['id' => $pagoId->id_pago])
                    ->execute();
            }

            //Save the cancelation in the cancelation tables, here if where superamdin do notthin 
            $cancelacionModel->save();

            
            $txn->commit();

            Yii::$app->response->statusCode = 200;
            return "Boleto cancelado";
        } catch (\Exception $e) {
            $txn->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $txn->rollBack();
            throw $e;
        }
    }

    public function actionPagar($horarioid)
    {
        $faceUserID     = 8;
        $userID         = Yii::$app->user->id;
        $salaAsientosID = Yii::$app->request->getBodyParam('asientos', []);
        $precios        = Yii::$app->request->getBodyParam('precios', []);
        $type           = Yii::$app->request->getBodyParam('type', false);

        if (!is_array($precios) || empty($precios) || empty($salaAsientosID)) {
            throw new HttpException(400, 'Hay un error con los datos de la llamada');
        }

        if ($type == false || !in_array($type, $this->_paymentTypes, true)) {
            throw new HttpException(400, 'Tipo de pago no soportado');
        }

        $horarioFuncion = HorarioFuncion::findOne($horarioid);
        if (is_null($horarioFuncion)) {
            throw new HttpException(404, 'Horario no encontrado');
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

            $boleto = new Boleto();

            $boleto->face_user_id       = $faceUserID;
            $boleto->horario_funcion_id = $horarioFuncion->id;
            $boleto->reclamado          = 0;
            $boleto->user_id            = $userID;
            $boleto->tipo_pago          = $type;

            if (!$boleto->save()) {
                throw new HttpException(400, 'Hubo un error al guardar tu boleto');
            }

            foreach ($salaAsientos as $idx => $salaAsiento) {
                $boletoAsiento                     = new BoletoAsiento();
                $boletoAsiento->sala_asiento_id    = $salaAsiento->id;
                $boletoAsiento->horario_funcion_id = $boleto->horario_funcion_id;
                $boletoAsiento->boleto_id          = $boleto->id;
                $boletoAsiento->precio_id          = $precios[$idx]->precio->id;
                $boletoAsiento->precio             = ($precios[$idx]->usar_especial == 1) ? $precios[$idx]->precio->especial : $precios[$idx]->precio->default;
                if (!$boletoAsiento->save()) {
                    throw new HttpException(400, 'Hubo un error al apartar tus asientos');
                }
            }

            $boleto->setQR();
            if (!$boleto->save()) {
                throw new HttpException(400, 'Hubo un error al guardar tu boleto');
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
                        throw new HttpException(400, 'Hubo un error al procesar tu Pago');
                    }
                    break;

                default:
                    throw new HttpException(422, 'Tipo de pago no valido');
                    break;
            }

            $boleto->id_pago = $pago->id;
            if (!$boleto->save()) {
                throw new HttpException(400, 'Hubo un error al procesar tu boleto');
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