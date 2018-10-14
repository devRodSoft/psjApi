<?php
namespace api\controllers;

use api\models\SalaRest;
use yii\rest\ActiveController;

class SalaController extends ActiveController
{
    public $modelClass = 'common\models\sala';

    public function actions()
    {
        return [
            'index',
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $data = SalaRest::find()->all();

        return $data;

    }

    public function actionView($id)
    {
        $data = SalaRest::find()->where(['id' => $id])->all();

        return $data;

    }
}
