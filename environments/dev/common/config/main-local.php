<?php

$db = [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=db;dbname=apiDB',
    'username' => 'api',
    'password' => 'secret',
    'charset' => 'utf8',
];

return [
    'components' => [
        'db' => $db,
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
