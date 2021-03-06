<?php

namespace api\modules\controllers;

use api\controllers\BaseAuthController;
use common\models\Boleto;
use common\models\BoletoAsiento;
use common\models\HorarioFuncion;
use common\models\HorarioPrecio;
use common\models\Pago;
use common\models\SalaAsientos;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment ;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use Yii;
use yii\web\HttpException;

class PagoController extends BaseAuthController
{
    public $modelClass = 'common\models\Pago';

    private $paymentTypes = ['openpay', 'paypal'];

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

    public function actionPagar($horarioid)
    {
        $faceUserID     = Yii::$app->user->id;
        $salaAsientosID = Yii::$app->request->getBodyParam('asientos', []);
        $precios        = Yii::$app->request->getBodyParam('precios', []);
        $payData        = Yii::$app->request->getBodyParam('data', []);
        $type           = Yii::$app->request->getBodyParam('type', false);

        if (
            !is_array($precios) ||
            !is_array($payData) ||
            empty($precios) ||
            empty($payData) ||
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
            ->innerJoin(['hf' => 'horario_funcion'], 'hf.id = boleto_asiento.horario_funcion_id')
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
            throw new \yii\web\HttpException(409, 'Uno o mas asientos no están disponibles');
        }
        if (empty($precioHorarios) || count($precioHorarios) !== count(array_unique($precios))) {
            throw new \yii\web\HttpException(422, 'Error algún precio no es valido');
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
            $boleto->tipo_pago          = $type;

            if (!$boleto->save()) {
                throw new \yii\web\HttpException(400, 'Hubo un error al guardar tu boleto');
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
                throw new \yii\web\HttpException(400, 'Hubo un error al guardar tu boleto');
            }

            switch ($type) {
                case 'openpay':
                    if (!isset($payData['token_id'])) {
                        throw new \yii\web\HttpException(402, 'Error token_id de pago no valido');
                    }

                    $payData = $this->DoOpenPayTX($payData, $boleto);

                    $pago = new Pago();

                    $pago->face_user_id    = $faceUserID;
                    $pago->create_time     = $payData->creation_date;
                    $pago->id_pago_externo = $payData->authorization;
                    $pago->intent          = $payData->operation_type;
                    $pago->state           = $payData->status;
                    $pago->tipo_pago       = 'openpay';

                    if (!$pago->save()) {
                        throw new \yii\web\HttpException(400, 'Hubo un error al procesar tu Pago');
                    }
                    break;

                case 'paypal':
                    if (!isset($payData['id']) || !$this->checkPaypalPayment($payData['id'])) {
                        throw new \yii\web\HttpException(402, 'Error Pago no valido');
                    }

                    $pago = new Pago();

                    $pago->face_user_id    = $faceUserID;
                    $pago->create_time     = $payData['create_time'];
                    $pago->id_pago_externo = $payData['id'];
                    $pago->intent          = $payData['intent'];
                    $pago->state           = $payData['state'];
                    $pago->tipo_pago       = 'paypal';

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

    private function checkPaypalPayment($paypalID)
    {
        $curl = curl_init("https://api.paypal.com/v2/checkout/orders/" . $paypalID);
        $curl = curl_init(Yii::$app->params['paypal']['url'] . "/checkout/orders/" . $paypalID);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . "AR8oJl1SkfPfE2EOwVIlXHE86TE0vtLQMr_4NwLg9zuOAE_NI9Jy76hNQbR6BQxn19ebeoFwDbXTR109" . ':' . "EPYgk1n_PJ-ZqACCOc2Ccqw2Iuf_rbh-ARZJUua446FWSwbGyOxXsbQaybPZfxQDLB6FqTbVVdvuMxvW",
            'Accept: application/json',
            'Content-Type: application/json',
        ));
        $response = curl_exec($curl);
        $result   = json_decode($response);

        // Creating an environment
        $clientId     = "AR8oJl1SkfPfE2EOwVIlXHE86TE0vtLQMr_4NwLg9zuOAE_NI9Jy76hNQbR6BQxn19ebeoFwDbXTR109";
        $clientSecret = "EPYgk1n_PJ-ZqACCOc2Ccqw2Iuf_rbh-ARZJUua446FWSwbGyOxXsbQaybPZfxQDLB6FqTbVVdvuMxvW";

        $environment = new ProductionEnvironment($clientId, $clientSecret);
        $client      = new PayPalHttpClient($environment);

        // Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
        // $response->result->id gives the orderId of the order created above
        $request = new OrdersCaptureRequest($paypalID);
        $request->prefer('return=representation');
        try {
            // var_dump();
            //$response = $client->execute($request);

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            // var_dump($response);
        } catch (Exception $ex) {
            // var_dump($ex);
        }

        // die();
        return true;
    }

    private function DoOpenPayTX($openpayData, $boleto)
    {
        $openpay = \Openpay::getInstance(
            Yii::$app->params['openpay']['merchant-id'],
            Yii::$app->params['openpay']['private-key']
        );

        // var_dump($openpay);die();

        $customer = [
            'name' => $openpayData["name"],
            'last_name' => $openpayData["last_name"],
            'phone_number' => $openpayData["phone_number"],
            'email' => $openpayData["email"],
        ];

        $chargeData = [
            'method' => 'card',
            'source_id' => $openpayData["token_id"],
            'amount' => (float) $boleto->total,
            'description' => 'boletos: ' . $boleto->pelicula->nombre,
            'device_session_id' => $openpayData["device_session_id"],
            'customer' => $customer,
        ];
        try {
            $charge = $openpay->charges->create($chargeData);
        } catch (\Exception $e) {
            throw new \yii\web\HttpException(422, $e->getMessage());
        }

        return $charge;
    }
}
