<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use yii\bootstrap\Html;
use backend\controllers\BaseCtrl;
use backend\models\ReporteSearch;
use common\models\Distribuidora;
use common\models\Pelicula;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;


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
    public function actionDia()
    {
        $searchModel  = new ReporteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $title = 'Ventas por dia';
        $url = 'dia';
        $columns = [
            //['attribute' => 'nombre_pelicula', 'label' => 'Pelicula'],
            [
                'attribute' => 'nombre_pelicula', 
                'width' => '310px',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Pelicula::find()->orderBy('nombre')->asArray()->all(), 'id', 'nombre'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any supplier'],
                'group' => true,  // enable grouping
            ],
            ['attribute' => 'nombre_distribuidor', 'label' => 'Distribuidora'],
            'fecha:date',
            'hora:time',
            [
                'label' => 'Sala',
                'value' => function ($m) {
                    return $m->sala->nombre;
                }
            ],
            ['attribute' => 'nombre', 'label' => 'Tipo'],
            ['attribute' => 'precio', 'label' => 'Precio', 'format' => 'currency'],
            ['attribute' => 'conteo', 'label' => 'Entradas'],
            'total:currency',
        ];

        $searchTemplate = '_bdia.php';
        $searchTemplateData = [
            'filterModel' => $searchModel,
            'url' => $url,
            'usuarios' => array_column(User::find()->all(), 'username', 'username'),
        ];

        return $this->renderReport(
            $title,
            $url,
            $searchModel,
            $dataProvider,
            $columns,
            $searchTemplate,
            $searchTemplateData
        );
    }

    /**
     * Lists all Reporte models.
     * @return mixed
     */
    public function actionFuncion()
    {
        $searchModel  = new ReporteSearch();
        $dataProvider = $searchModel->searchuFuncion(Yii::$app->request->queryParams);
        $title = 'Boletos por funciones';
        $url = 'funcion';
        $columns = [
            ['attribute' => 'nombre_pelicula', 'label' => 'Pelicula'],
            ['attribute' => 'nombre_distribuidor', 'label' => 'Distribuidora'],
            'fecha:date',
            'hora:time',
            [
                'label' => 'Sala',
                'value' => function ($m) {
                    return $m->sala->nombre;
                }
            ],
            ['attribute' => 'nombre', 'label' => 'Tipo'],
            ['attribute' => 'precio', 'label' => 'Precio', 'format' => 'currency'],
            ['attribute' => 'conteo', 'label' => 'Entradas'],
        ];

        // $usuarios = array_column(User::find()->all(), 'username', 'username');
        $searchTemplate = '_bfuncion.php';
        $searchTemplateData = [
            'filterModel' => $searchModel,
            'url' => $url,
            'distribuidoras' => array_column(Distribuidora::find()->all(), 'nombre', 'nombre'),
            'peliculas' => array_column(Pelicula::find()->all(), 'nombre', 'nombre'),
        ];

        return $this->renderReport(
            $title,
            $url,
            $searchModel,
            $dataProvider,
            $columns,
            $searchTemplate,
            $searchTemplateData
        );
    }

    /**
     * Lists all Reporte models.
     * @return mixed
     */
    public function actionPelicula()
    {
        //group by price type *****
        $searchModel  = new ReporteSearch();
        $dataProvider = $searchModel->searchPelicula(Yii::$app->request->queryParams);
        $title = 'Boletos por peliculas';
        $url = 'pelicula';
        $columns = [
            ['attribute' => 'nombre_pelicula', 'label' => 'Pelicula'],
            ['attribute' => 'nombre_distribuidor', 'label' => 'Distribuidora'],
            'fecha:date',
            //'hora:time',
            ['attribute' => 'nombre', 'label' => 'Tipo'],
           // ['attribute' => 'precio', 'label' => 'Precio', 'format' => 'currency'],
            ['attribute' => 'conteo', 'label' => 'Entradas'],
            //'total:currency',
        ];

        // $usuarios = array_column(User::find()->all(), 'username', 'username');

        $searchTemplate = '_bpelicula.php';
        $searchTemplateData = [
            'filterModel' => $searchModel,
            'url' => $url
        ];
        return $this->renderReport(
            $title,
            $url,
            $searchModel,
            $dataProvider,
            $columns,
            $searchTemplate,
            $searchTemplateData
        );
    }

    /**
     * Lists all Reporte models.
     * @return mixed
     */
    public function actionVperiodo()
    {
        $searchModel  = new ReporteSearch();
        $dataProvider = $searchModel->searchDistribuidor(Yii::$app->request->queryParams);
        $title = 'Ventas por Periodo';
        $url = 'vperiodo';
        $columns = [
            ['attribute' => 'nombre_pelicula', 'label' => 'Pelicula'],
            ['attribute' => 'nombre_distribuidor', 'label' => 'Distribuidora'],
            'fecha:date',
            'hora:time',
            [
                'label' => 'Sala',
                'value' => function ($m) {
                    return $m->sala->nombre;
                }
            ],
            ['attribute' => 'nombre', 'label' => 'Tipo'],
            ['attribute' => 'precio', 'label' => 'Precio', 'format' => 'currency'],
            ['attribute' => 'conteo', 'label' => 'Entradas'],
        ];

        // $usuarios = array_column(User::find()->all(), 'username', 'username');
        $searchTemplate = '_bperiodo.php';
        $searchTemplateData = [
            'filterModel' => $searchModel,
            'url' => $url,
            'distribuidoras' => array_column(Distribuidora::find()->all(), 'nombre', 'nombre'),
            'peliculas' => array_column(Pelicula::find()->all(), 'nombre', 'nombre'),
            'usuarios' => array_column(User::find()->all(), 'username', 'username'),
        ];
        return $this->renderReport(
            $title,
            $url,
            $searchModel,
            $dataProvider,
            $columns,
            $searchTemplate,
            $searchTemplateData
        );
    }

    public function actionBperiodo()
    {
        $searchModel  = new ReporteSearch();
        $dataProvider = $searchModel->searchDistribuidor(Yii::$app->request->queryParams);
        $title = 'Boletos por Periodo';
        $url = 'bperiodo';
        $columns = [
            ['attribute' => 'nombre_pelicula', 'label' => 'Pelicula'],
            ['attribute' => 'nombre_distribuidor', 'label' => 'Distribuidora'],
            'fecha:date',
            'hora:time',
            [
                'label' => 'Sala',
                'value' => function ($m) {
                    return $m->sala->nombre;
                }
            ],
            ['attribute' => 'nombre', 'label' => 'Tipo'],
            ['attribute' => 'precio', 'label' => 'Precio', 'format' => 'currency'],
            ['attribute' => 'conteo', 'label' => 'Entradas'],
        ];
        $searchTemplate = '_bperiodo.php';
        $searchTemplateData = [
            'filterModel' => $searchModel,
            'url' => $url,
            'distribuidoras' => array_column(Distribuidora::find()->all(), 'nombre', 'nombre'),
            'peliculas' => array_column(Pelicula::find()->all(), 'nombre', 'nombre'),
            'usuarios' => array_column(User::find()->all(), 'username', 'username'),
        ];
        // $usuarios = array_column(User::find()->all(), 'username', 'username');

        return $this->renderReport(
            $title,
            $url,
            $searchModel,
            $dataProvider,
            $columns,
            $searchTemplate,
            $searchTemplateData
        );
    }

    private function renderReport($title, $url, $searchModel, $dataProvider, $columns, $searchTemplate, $searchTemplateData)
    {
        return $this->render(
            'report',
            [
                // return $this->render('pelicula', [
                'title' => $title,
                'url' => $url,
                'searchTemplate' => $searchTemplate,
                'searchTemplateData' => $searchTemplateData,
                'filterModel' => $searchModel,
                'widgetData' => [
                    'export' => [
                        'label' => 'Exportar reporte'
                    ],
                    'exportConfig' => [
                        GridView::HTML => [],
                        GridView::PDF => [
                            'config' => [
                                'mode' => 'utf-8',
                                'format' => 'Letter',
                                'destination' => 'D',
                                'methods' => [
                                    'SetHeader' => [$title],
                                    'SetFooter' => ['{PAGENO}']
                                ]
                            ]
                        ],
                    ],
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'toolbar' => [
                        '{export}',
                        '{toggleData}'
                    ],
                    'panel' => [
                        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> ' . $title . '</h3>',
                        'type' => 'success',
                        'after' => ' {pager}' . '<br>' . Html::a('<i class="fas fa-redo"></i> Reiniciar filtros', [$url], ['class' => 'btn btn-info']),
                        'footer' => false
                    ],
                    'columns' => $columns,
                ]
            ]
        );
    }
}
