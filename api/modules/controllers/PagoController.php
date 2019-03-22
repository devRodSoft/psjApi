<?php
namespace api\modules\controllers;

use api\controllers\BaseAuthController;
use common\models\Boleto;
use common\models\BoletoAsiento;
use common\models\HorarioFuncion;
use common\models\Pago;
use common\models\SalaAsientos;
use Yii;

class PagoController extends BaseAuthController
{
    public $modelClass = 'common\models\Pago';

    public function actions()
    {
        return [
            'index',
            'ping',
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    // 'client' => [
    //        'environment' => 'sandbox',
    //        'paypal_sdk_version' => '2.15.3',
    //        'platform' => 'Android',
    //        'product_name' => 'PayPal-Android-SDK',
    //    ],
    //    "response": {
    //        "create_time": "2018-12-13T05:31:04Z",
    //        "id": "PAY-9JD506026M041730BLQI65EY",
    //        "intent": "sale",
    //        "state": "approved",
    //    },
    //    "response_type" => "payment",
    //
    //
    //
    //    curl -v -X GET https://api.sandbox.paypal.com/v2/checkout/orders/5O190127TN364715T \
    // -H "Content-Type: application/json" \
    // -H "Authorization: Bearer Access-Token"

    public function actionPagar($id)
    {
        $faceUserID       = Yii::$app->user->id;
        $salaAsientosID   = Yii::$app->request->getBodyParam('asientos', []);
        $horarioFuncionID = empty($id) ? false : $id;
        $payResponse      = Yii::$app->request->getBodyParam('paypalResponse', false);

        if ($horarioFuncionID == false || empty($salaAsientosID) || $payResponse == false) {
            throw new \yii\web\HttpException(400, 'Hay un error con el ID de asiento, pago o funcion');
        }

        $horarioFuncion = HorarioFuncion::findOne($horarioFuncionID);
        if (is_null($horarioFuncion)) {
            throw new \yii\web\HttpException(404, 'Horario no encontrado');
        }

        $salaAsientos = SalaAsientos::find()
            ->innerJoin(['hf' => 'horario_funcion'], 'hf.sala_id = sala_asientos.sala_id')
            ->leftJoin(['ba' => 'boleto_asiento'], 'ba.sala_asiento_id = sala_asientos.id')
            ->leftJoin(['b' => 'boleto'], 'b.id = ba.boleto_id AND hf.id = b.horario_funcion_id')
            ->where(['in', 'sala_asientos.id', $salaAsientosID])
            ->andWhere(['hf.id' => $horarioFuncionID])
            ->andWhere('b.id IS NULL')
            ->all();

        $NSalaAsientos = count($salaAsientosID);
        if (empty($salaAsientos) || count($salaAsientos) != $NSalaAsientos || $NSalaAsientos > Yii::$app->params['maxBoletos']) {
            throw new \yii\web\HttpException(409, 'Uno o mas asientosParecen no estar disponibles');
        }
        if (!isset($payResponse['id']) || !$this->checkPayment($payResponse['id'])) {
            throw new \yii\web\HttpException(402, 'Error Pago no valido');
        }

        $txn = Yii::$app->db->beginTransaction();

        try {
            $pago = new Pago();

            $pago->face_user_id   = $faceUserID;
            $pago->create_time    = $payResponse['create_time'];
            $pago->id_pago_paypal = $payResponse['id'];
            $pago->intent         = $payResponse['intent'];
            $pago->state          = $payResponse['state'];

            if (!$pago->save()) {
                throw new \yii\web\HttpException(400, 'Hubo un error al procesar tu Pago');
            }

            $boleto = new Boleto();

            $boleto->face_user_id       = $faceUserID;
            $boleto->horario_funcion_id = $horarioFuncion->id;
            $boleto->reclamado          = 0;

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
            $txn->commit();

            return ['id' => $boleto->id];
        } catch (\Exception $e) {
            $txn->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $txn->rollBack();
            throw $e;
        }
    }

    private function checkPayment($paypalID)
    {
        $curl = curl_init("https://api.sandbox.paypal.com/v2/checkout/orders/" . $paypalID);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . Yii::$app->params['paypal']['client_id'] . ':' . Yii::$app->params['paypal']['secret'],
            'Accept: application/json',
            'Content-Type: application/json',
        ));
        $response = curl_exec($curl);
        $result   = json_decode($response);
        // var_dump($result);
        return true;
    }
}
