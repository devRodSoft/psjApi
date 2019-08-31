<?php
namespace taquilla\modules\controllers;

use taquilla\controllers\BaseAuthController;
use Yii;

class UserController extends BaseAuthController
{
    public $modelClass = 'common\models\User';

    public function actions()
    {
        return [
            'current',
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    public function actionCurrent()
    {
        return Yii::$app->user->identity;
    }
}
