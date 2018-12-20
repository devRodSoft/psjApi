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

        return '';
    }

    public function actionReservar()
    {
        return '';

    }
}
