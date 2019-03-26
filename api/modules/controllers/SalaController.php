<?php
namespace api\modules\controllers;

use api\controllers\BaseController;
use api\models\SalaRest;
use common\models\HorarioFuncion;

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
        $data = SalaRest::find()->where(['id' => $id])->one();

        return $data;

    }

    public function actionOcupados($id)
    {

        $hr   = HorarioFuncion::findOne($id);
        $data = SalaRest::find()->select(['*', 'horario' => '(select ' . $hr->id . ')'])->where(['id' => $hr->sala_id])->all();

        return $data;

    }
}
