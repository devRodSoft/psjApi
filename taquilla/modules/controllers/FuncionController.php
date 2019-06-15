<?php
namespace api\modules\controllers;

use api\controllers\BaseController;
use api\models\FuncionRest;
use common\models\HorarioFuncion;
use common\models\Pelicula;
use Yii;
use yii\db\Query;

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
        $ymd  = \DateTime::createFromFormat('Y-m-d', $fecha)->format('Y-m-d');
        $data = FuncionRest::find()
            ->select(['*', 'date' => '("' . $ymd . '")'])
            ->where('publicar = 1')
            ->andWhere(['in', 'id', HorarioFuncion::find()->select('funcion_id')->where(['fecha' => $ymd])])
            ->all();

        return $data;
    }

    public function actionIndexnow()
    {

        return $this->actionIndex(date('Y-m-d'));
    }

    public function actionEstrenos()
    {
        $data = Pelicula::find()
            ->select('pelicula.*, DATE(f.estreno_inicio) as estreno_inicio, DATE(f.estreno_fin) as estreno_fin')
            ->innerJoin(['f' => 'funcion'], 'f.pelicula_id = pelicula.id')
            ->where('f.publicar = 1 AND f.estreno_inicio > NOW() AND f.estreno_fin > NOW()')
            ->groupBy('pelicula.id')
            ->asArray(true)
            ->all();

        return $data;
    }

    public function actionFechas()
    {
        $query = new Query;
        // compose the query
        $query->select('fecha')
            ->distinct()
            ->from('horario_funcion')
            ->where('fecha >= cast(NOW() AS DATE)')
            ->addOrderBy(['fecha' => SORT_ASC])
            ->limit(intval(Yii::$app->request->getQueryParam('limit', 15)));

        return $query->column();

    }
}
