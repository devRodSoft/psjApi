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

                'GET boletos' => 'general/boletos/search',
                'OPTIONS boletos' => 'general/boletos/options',

                // 'GET boletos/<id:[\-A-Z]+\d+>' => 'general/boletos/reimpresion',
                // 'OPTIONS boletos/<id:[\-A-Z]+\d+>' => 'general/boletos/options',

                'GET boletos/validar/<id:[\-A-Z]+\d+>' => 'general/boletos/validar-boleto',
                'OPTIONS boletos/validar/<id:[\-A-Z]+\d+>' => 'general/boletos/options',

                'POST boletos/horario/<horarioid:\d+>/pagar' => 'general/boletos/pagar',
                'OPTIONS boletos/horario/<horarioid:\d+>/pagar' => 'general/boletos/options',

                'POST oauth/<action:\w+>' => 'authentication/<action>',
                'OPTIONS oauth/<action:\w+>' => 'authentication/options',

                //cancelacion
                'DELETE boletos/cancelar/<boletoAsientoId:\d+>/<deleteAll:\d+>' => 'general/boletos/cancelar',
                'OPTIONS boletos/cancelar/<boletoAsientoId:\d+>/<deleteAll:\d+>' => 'general/boletos/options',

                //find by code
                'GET boletos/code/<codigoBoleto\d+>' => 'general/boletos/code',
                'OPTIONS boletos/code/<codigoBoleto\d+>' => 'general/boletos/options',

                //apartar
                'POST apartados/horario/<horarioid:\d+>' => 'general/apartados/apartar',
                'OPTIONS apartados/horario/<horarioid:\d+>' => 'general/apartados/options',

                //listado apartar
                'GET apartados/horario/<horarioid:\d+>' => 'general/apartados/listar-apartados',
                'OPTIONS apartados/horario/<horarioid:\d+>' => 'general/apartados/options',

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
