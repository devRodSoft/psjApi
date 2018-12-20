<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'api-cine',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'defaultRoute' => 'public/index',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\FaceUser',
            'enableAutoLogin' => true,
            // 'identityCookie' => ['name' => '_identity-front', 'httpOnly' => true],
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'format' => \yii\web\Response::FORMAT_JSON,
        ],
        'qr' => [
            'class' => '\Da\QrCode\Component\QrCodeComponent',
            // ... you can configure more properties of the component here
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                'GET sala' => 'general/sala/index',
                'GET user/boletos' => 'general/user/boletos',
                'GET sala/<id:\d+>' => 'general/sala/view',
                'GET cartelera/<fecha:\d+>' => 'general/funcion/index',
                'GET horario/<id:\d+>/sala' => 'general/sala/ocupados',
                'GET user/boletos/<id:\d+>' => 'general/user/boleto',

                'POST ping' => 'general/funcion/ping',
                'POST oauth/<action:\w+>' => 'authentication/<action>',
                'POST horario/<id:\d+>/sala' => 'general/pago/pagar',
                'POST horario/<id:\d+>/sala/reserva' => 'general/pago/reservar',

                // OPTIONS
                'OPTIONS ping' => 'general/funcion/options',
                'OPTIONS sala' => 'general/sala/options',
                'OPTIONS sala/<id:\d+>' => 'general/sala/options',
                'OPTIONS oauth/<action:\w+>' => 'authentication/<action>',
                'OPTIONS horario/<hid:\d+>/sala' => 'general/sala/options',
                'OPTIONS cartelera/<fecha:\d+>' => 'general/funcion/options',
                'OPTIONS horario/<hid:\d+>/sala/<id:\d+>' => 'general/sala/options',
                ['class' => 'yii\rest\UrlRule', 'controller' => 'general/face-user'],
            ],
        ],

    ],
    'modules' => [
        'general' => [
            'class' => 'api\modules\General',
        ],
        'oauth2' => [
            'class' => 'filsh\yii2\oauth2server\Module',
            'tokenParamName' => 'accessToken',
            'tokenAccessLifetime' => 3600 * 24,
            'storageMap' => [
                'user_credentials' => 'common\models\FaceUser',
            ],
            'grantTypes' => [
                'user_credentials' => [
                    'class' => 'OAuth2\GrantType\UserCredentials',
                ],
                'refresh_token' => [
                    'class' => 'OAuth2\GrantType\RefreshToken',
                    'always_issue_new_refresh_token' => true,
                ],
            ],
        ],
    ],
    'params' => $params,
];
