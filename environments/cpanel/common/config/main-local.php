<?php
$db = [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=plazasan_db',
    'username' => 'plazasan_site_ad',
    'password' => '88@4815162342',
    'charset' => 'utf8',
];
return [
    'components' => [
        'db' => $db,
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'db' => $db,
                    'levels' => ['info'],
                    'categories' => ['yii\db\Command*'],
                ],
            ],
        ],
    ],
];
