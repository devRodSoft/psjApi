<?php
namespace api\modules\controllers;

use api\controllers\BaseController;
use api\models\SalaRest;

class SalaController extends BaseController
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
