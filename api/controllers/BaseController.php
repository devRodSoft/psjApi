<?php
namespace api\controllers;

use yii\rest\ActiveController;

class BaseController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // // remove authentication filter
        // $auth = $behaviors['authenticator'];
        // unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                // restrict access to
                'Access-Control-Allow-Origin' => ['*'],
                'Origin' => ['*'],
                // Allow only POST and PUT methods
                // 'Access-Control-Request-Method'    => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Method' => ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'OPTIONS'],
                // Allow only headers 'X-Wsse'
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Headers' => ['*'],
                // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
                'Access-Control-Allow-Credentials' => true,
                // Allow OPTIONS caching
                'Access-Control-Max-Age' => 3600,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => [
                    'X-Pagination-Current-Page',
                    'Access-Control-Allow-Origin',
                    'X-Pagination-Page-Count',
                    'X-Pagination-Per-Page',
                    'X-Pagination-Total-Count',
                ],
            ],
        ];

        // // re-add authentication filter
        // $behaviors['authenticator'] = $auth;
        // // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        // $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }
}
