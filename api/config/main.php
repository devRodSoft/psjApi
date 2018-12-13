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
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            // 'identityCookie' => ['name' => '_identity-front', 'httpOnly' => true],
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'i18n' => [
            'translations' => [
                'conquer/oauth2' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => '@conquer/oauth2/messages',
                ],
            ],
        ],
        'response' => [
            'format' => \yii\web\Response::FORMAT_JSON,
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
                'GET token' => 'authentication/token',
                'GET cartelera/<fecha:\d+>' => 'general/funcion/index',
                'GET sala' => 'general/sala/index',
                'GET sala/<id:\d+>' => 'general/sala/view',
                'GET horario/<id:\d+>/sala' => 'general/sala/ocupados',

                'POST ping' => 'general/funcion/ping',

                // OPTIONS
                'OPTIONS try' => 'general/funcion/options',
                'OPTIONS horario/<hid:\d+>/sala/<id:\d+>' => 'general/sala/options',
                'OPTIONS cartelera/<fecha:\d+>' => 'general/funcion/options',
                'OPTIONS sala' => 'general/sala/options',
                'OPTIONS sala/<id:\d+>' => 'general/sala/options',
                'OPTIONS token' => 'auth/token',
                ['class' => 'yii\rest\UrlRule', 'controller' => 'general/user'],
            ],
        ],

    ],
    'modules' => [
        'general' => [
            'class' => 'api\modules\General',
        ],
    ],
    'params' => $params,
];
