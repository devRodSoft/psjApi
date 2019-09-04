<?php

namespace backend\controllers;

use Yii;
use common\models\Reporte;
use backend\models\ReporteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
* ReporteController implements the CRUD actions for Reporte model.
*/
class ReporteController extends Controller
{
    /**
    * {@inheritdoc}
    */
    public function behaviors()
    {
        return [
        ];
    }

    /**
    * Lists all Reporte models.
    * @return mixed
    */
    public function actionIndex()
    {
        return $this->render('index', []);
    }

    /**
    * Lists all Reporte models.
    * @return mixed
    */
    public function actionGeneral()
    {
        $searchModel  = new ReporteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('report', [
        // return $this->render('general', [
            'title'=>'General',
            'widgetData' => [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'nombre_pelicula',
                    'idioma',
                    'hora',
                    'fecha',
                    'nombre',
                    'precio',
                    'tipo_pago',
                    'username',
                    'nombre_distribuidor',
                ],
            ]
        ]);
    }

    /**
    * Lists all Reporte models.
    * @return mixed
    */
    public function actionUsuarios()
    {
        $searchModel  = new ReporteSearch();
        $dataProvider = $searchModel->searchUsuarios(Yii::$app->request->queryParams);

        return $this->render('report', [
        // return $this->render('usuarios', [
            'title'=>'Usuarios',
            'widgetData' => [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'nombre_pelicula',
                    'idioma',
                    'hora',
                    'fecha',
                    'nombre',
                    'precio',
                    'tipo_pago',
                    'username',
                    'nombre_distribuidor',
                ],
            ]
        ]);
    }

    /**
    * Lists all Reporte models.
    * @return mixed
    */
    public function actionPelicula()
    {
        $searchModel  = new ReporteSearch();
        $dataProvider = $searchModel->searchPelicula(Yii::$app->request->queryParams);

        return $this->render('report', [
        // return $this->render('pelicula', [
            'title'=>'Pelicula',
            'widgetData' => [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'nombre_pelicula',
                    'idioma',
                    'hora',
                    'fecha',
                    'nombre',
                    'precio',
                    'tipo_pago',
                    'username',
                    'nombre_distribuidor',
                ],
            ]
        ]);
    }

    /**
    * Lists all Reporte models.
    * @return mixed
    */
    public function actionDistribuidor()
    {
        $searchModel  = new ReporteSearch();
        $dataProvider = $searchModel->searchDistribuidor(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;

        $this->layout = 'print';
        return $this->render('imprimir', [
        // return $this->render('distribuidor', [
            'title'=>'Distribuidor',
            'widgetData' => [
                'showHeader' => false,
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'nombre_pelicula',
                    'idioma',
                    'hora',
                    'fecha',
                    'nombre',
                    'precio',
                    'tipo_pago',
                    'username',
                    'nombre_distribuidor',
                ],
            ]
        ]);
    }
}
