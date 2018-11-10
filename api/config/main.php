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
            'csrfParam' => '_csrf-api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'format' => \yii\web\Response::FORMAT_JSON,
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '161770838095524',
                    'clientSecret' => 'ba3660c38b312053c11103c51b7d18ba',
                    'attributeNames' => [
                        'id',
                        'name',
                        'first_name',
                        'last_name',
                        'about',
                        'work',
                        'education',
                        'gender',
                        'email',
                    ],
                    'scope' => [
                        'user_location',
                    ],
                ],
            ],
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
                ['class' => 'yii\rest\UrlRule', 'controller' => 'general/user'],
                'GET cartelera/<fecha:\d+>' => 'general/funcion/index',
                'GET sala' => 'general/sala/index',
                'GET sala/<id:\d+>' => 'general/sala/view',

                // OPTIONS
                'OPTIONS cartelera/<fecha:\d+>' => 'general/funcion/options',
                'OPTIONS sala' => 'general/sala/options',
                'OPTIONS sala/<id:\d+>' => 'general/sala/options',
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
