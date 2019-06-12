<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web';
    public $css      = [
        'css/site.css',
        'https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.css',
        'https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.2.0/main.css',
        'https://cdn.jsdelivr.net/npm/@fullcalendar/list@4.2.0/main.css',
        'https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.2.0/main.css',
    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.js',
        'https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.2.0/main.js',
        'https://cdn.jsdelivr.net/npm/@fullcalendar/list@4.2.0/main.js',
        'https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.2.0/main.js',
        'https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.2.0/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
