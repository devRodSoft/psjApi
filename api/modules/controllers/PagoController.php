<?php
namespace api\modules\controllers;

use api\controllers\BaseAuthController;

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

    public function actionPagar()
    {
        // "response": {
        //        "create_time": "2018-12-13T05:31:04Z",
        //        "id": "PAY-9JD506026M041730BLQI65EY",
        //        "intent": "sale",
        //        "state": "approved",
        //    },
        return '';
    }

    public function actionReservar()
    {
        $faceUserID     = Yii::$app->user->id;
        $salaAsientoID  = Yii::$app->request->getBodyParam('asientoId', false);
        $horarioFuncionID = Yii::$app->request->getBodyParam('horarioId', false);

        if ($horarioFuncionID == false || $salaAsientoID == false) {
            throw new \yii\web\HttpException(400, 'Hay un error con el ID de asiento o funcion');
        }

        $horarioFuncion = HorarioFuncion::find($horarioFuncionID);
        if (is_null($horarioFuncion)) {
            throw new \yii\web\HttpException(404, 'Hay un error con el ID de horario ');
        }

        $salaAsiento = SalaAsiento::find($salaAsientoID);
        if (is_null($salaAsiento)) {
            throw new \yii\web\HttpException(404, 'Hay un error con el ID de asiento');
        }

        $boleto = new Boleto();

        $boleto->face_user_id       = $faceUserID;
        $boleto->horario_funcion_id = $horarioFuncionID;
        $boleto->sala_asientos_id   = $salaAsientoID;
        $boleto->reclamado          = 0;

        return ['id' => $boleto->id];
    }
}
