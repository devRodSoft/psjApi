<?php
namespace api\modules\controllers;

use api\controllers\BaseController;
use api\models\FuncionRest;

class FuncionController extends BaseController
{
    public $modelClass = 'common\models\Funcion';

    public function actions()
    {
        return [
            'index',
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    public function actionIndex($fecha)
    {
        $ymd  = \DateTime::createFromFormat('Ymd', $fecha)->format('Y-m-d');
        $data = FuncionRest::find()->joinWith(['horarioFuncions'], true, ['INNER JOIN'])->with(['horarioFuncions', 'pelicula'])->where(['horario_funcion.fecha' => $ymd])->all();

        return $data;

    }
}
