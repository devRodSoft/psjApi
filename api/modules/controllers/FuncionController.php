<?php
namespace api\modules\controllers;

use api\controllers\BaseController;
use api\models\FuncionRest;
use common\models\HorarioFuncion;
use Yii;

class FuncionController extends BaseController
{
    public $modelClass = 'common\models\Funcion';

    public function actions()
    {
        return [
            'index',
            'ping',
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    public function actionIndex($fecha)
    {
        $ymd  = \DateTime::createFromFormat('Ymd', $fecha)->format('Y-m-d');
        $data = FuncionRest::find()
            ->select(['*', 'date' => '("' . $ymd . '")'])
            ->where('publicar = 1')
            ->andWhere(['in', 'id', HorarioFuncion::find()->select('id')->where(['fecha' => $ymd])])
            ->all();

        return $data;
    }

    public function actionEstrenos()
    {
        $data = FuncionRest::find()
            ->select(['*'])
            ->where('publicar = 1 AND estreno >= NOW()')
            ->andWhere(['not in', 'id', HorarioFuncion::find()->select('id')->where('`fecha` <= NOW()')])
            ->all();

        return $data;
    }

    public function actionPing()
    {
        Yii::error(Yii::$app->request->getBodyParams(), 'BTW');

        return 'pong';

    }
}
