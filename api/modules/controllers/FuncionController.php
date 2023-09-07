<?php
namespace api\modules\controllers;

use api\controllers\BaseController;
use api\models\PeliculaRest;
use common\models\HorarioFuncion;
use common\models\Pelicula;
use Yii;
use yii\db\Query;

class FuncionController extends BaseController
{
    public $modelClass = 'common\models\pelicula';

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
        $ymd  = \DateTime::createFromFormat('Y-m-d', $fecha)->format('Y-m-d');
        $data = PeliculaRest::find()
            ->andWhere(['in', 'id', HorarioFuncion::find()->select('pelicula_id')->where(['fecha' => $ymd, 'publicar' => 1])])
            ->all();

        foreach ($data as &$pelicula) {
            $pelicula->addHorarios($ymd);
        }

        return $data;
    }

    public function actionIndexnow()
    {
        date_default_timezone_set('America/Mexico_City');
        return $this->actionIndex(date('Y-m-d'));
    }

    public function actionEstrenos()
    {
        $data = Pelicula::find()
            ->select('pelicula.*, DATE(e.inicio) as inicio, DATE(e.fin) as fin')
            ->innerJoin(['e' => 'estreno'], 'e.pelicula_id = pelicula.id')
            ->where('e.publicar = 1 AND e.inicio > NOW() AND e.fin > NOW()')
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
