<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use backend\controllers\BaseCtrl;
use backend\models\ReporteSearch;

/**
 * ReporteController implements the CRUD actions for Reporte model.
 */
class ReporteController extends BaseCtrl
{

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
        $view = 'report';
        $searchModel  = new ReporteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $print = Yii::$app->request->getQueryParam('print', false);

        $print = !!$print;

        if ($print) {
            $dataProvider->pagination = false;
            $this->layout = 'print';
            $view = 'imprimir';
        }

        $usuarios = array_column(User::find()->all(), 'username', 'username');

        return $this->render($view, [
            // return $this->render('general', [
            'title' => 'General',
            'usuarios' => $usuarios,
            'widgetData' => [
                'showHeader' => !$print,
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
        $view = 'report';
        $searchModel  = new ReporteSearch();
        $dataProvider = $searchModel->searchusuarios(Yii::$app->request->queryParams);
        $print = Yii::$app->request->getQueryParam('print', false);

        $print = !!$print;

        if ($print) {
            $dataProvider->pagination = false;
            $this->layout = 'print';
            $view = 'imprimir';
        }

        $usuarios = array_column(User::find()->all(), 'username', 'username');

        return $this->render($view, [
            // return $this->render('usuarios', [
            'title' => 'usuarios',
            'usuarios' => $usuarios,
            'widgetData' => [
                'showHeader' => !$print,
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'username',
                    'conteo',
                    'total:currency',
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
        $view = 'report';
        $searchModel  = new ReporteSearch();
        $dataProvider = $searchModel->searchPelicula(Yii::$app->request->queryParams);
        $print = Yii::$app->request->getQueryParam('print', false);

        $print = !!$print;

        if ($print) {
            $dataProvider->pagination = false;
            $this->layout = 'print';
            $view = 'imprimir';
        }

        $usuarios = array_column(User::find()->all(), 'username', 'username');

        return $this->render($view, [
            // return $this->render('pelicula', [
            'title' => 'Pelicula',
            'usuarios' => $usuarios,
            'widgetData' => [
                'showHeader' => !$print,
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'nombre_pelicula',
                    'nombre_distribuidor',
                    'fecha:date',
                    'hora:time',
                    'nombre',
                    'precio:currency',
                    'conteo',
                    'total:currency',
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
        $view = 'report';
        $searchModel  = new ReporteSearch();
        $dataProvider = $searchModel->searchDistribuidor(Yii::$app->request->queryParams);
        $print = Yii::$app->request->getQueryParam('print', false);

        $print = !!$print;

        if ($print) {
            $dataProvider->pagination = false;
            $this->layout = 'print';
            $view = 'imprimir';
        }

        $usuarios = array_column(User::find()->all(), 'username', 'username');

        return $this->render($view, [
            // return $this->render('distribuidor', [
            'title' => 'Distribuidor',
            'usuarios' => $usuarios,
            'widgetData' => [
                'showHeader' => !$print,
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'nombre_distribuidor',
                    'conteo',
                    'total:currency',

                ],
            ]
        ]);
    }
}
