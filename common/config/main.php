<?php
date_default_timezone_set('America/Mexico_City');
return [
    'language' => 'es-MX',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'defaultTimeZone' => 'America/Mexico_City',
            'currencyCode' => 'MXN',
            'locale' => 'es-ES',
            'nullDisplay' => '',
        ],
    ],
];
