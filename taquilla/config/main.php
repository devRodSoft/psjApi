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
    'controllerNamespace' => 'taquilla\controllers',
    'defaultRoute' => 'public/index',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
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

                // 'GET sala' => 'general/sala/index',
                // 'OPTIONS sala' => 'general/sala/options',

                'GET identity' => 'general/user/current',
                'OPTIONS identity' => 'general/user/options',

                'GET boletos/<email:[^@]+@[^\.]+\..+>/<fecha:\d{4}-\d{2}-\d{2}>' => 'general/boletos/search',
                'OPTIONS boletos/<email:[^@]+@[^\.]+\..+>/<fecha:\d{4}-\d{2}-\d{2}>' => 'general/boletos/options',

                // 'GET sala/<id:\d+>' => 'general/sala/view',
                // 'OPTIONS sala/<id:\d+>' => 'general/sala/options',

                // 'GET fechas' => 'general/funcion/fechas',
                // 'OPTIONS fechas' => 'general/funcion/options',

                // 'GET cartelera' => 'general/funcion/indexnow',
                // 'OPTIONS cartelera' => 'general/funcion/options',

                // 'GET cartelera/estrenos' => 'general/funcion/estrenos',
                // 'OPTIONS cartelera/estrenos => 'general/funcion/options',

                // 'GET cartelera/<fecha:\d{4}-\d{2}-\d{2}>' => 'general/funcion/index',
                // 'OPTIONS cartelera/<fecha:\d{4}-\d{2}-\d{2}>' => 'general/funcion/options',

                // 'GET horario/<id:\d+>/sala' => 'general/sala/ocupadosmtx',
                // 'OPTIONS horario/<hid:\d+>/sala' => 'general/sala/options',

                // 'GET user/boletos/<id:\d+>' => 'general/user/boleto',
                // 'OPTIONS user/boletos/<id:\d+>' => 'general/user/options',

                // 'GET user/boletos/<id:\d+>/qr' => 'general/user/qr',
                // 'OPTIONS user/boletos/<id:\d+>/qr' => 'general/user/options',

                // 'POST ping' => 'general/funcion/ping',
                // 'OPTIONS ping' => 'general/funcion/options',

                // 'POST horario/<id:\d+>/sala' => 'general/pago/pagar',
                // 'OPTIONS horario/<id:\d+>/sala' => 'general/pago/options',

                // 'GET promociones' => 'general/promocion/index',
                // 'OPTIONS promociones' => 'general/promocion/options',

                'POST boletos/horario/<horarioid:\d+>/pagar' => 'general/boletos/pagar',
                'OPTIONS boletos/horario/<horarioid:\d+>/pagar' => 'general/boletos/options',

                'POST oauth/<action:\w+>' => 'authentication/<action>',
                'OPTIONS oauth/<action:\w+>' => 'authentication/<action>',

                // OPTIONS
                // ['class' => 'yii\rest\UrlRule', 'controller' => 'general/face-user'],
            ],
        ],

    ],
    'modules' => [
        'general' => [
            'class' => 'taquilla\modules\General',
        ],
        'oauth2' => [
            'class' => 'filsh\yii2\oauth2server\Module',
            'tokenParamName' => 'accessToken',
            'tokenAccessLifetime' => 3600 * 24,
            'storageMap' => [
                'user_credentials' => 'common\models\User',
            ],
            'grantTypes' => [
                'user_credentials' => [
                    'class' => 'OAuth2\GrantType\UserCredentials',
                ],
                'refresh_token' => [
                    'class' => 'OAuth2\GrantType\RefreshToken',
                    'always_issue_new_refresh_token' => true,
                    'unset_refresh_token_after_use' => true,
                ],
            ],
        ],
    ],
    'params' => $params,
];
