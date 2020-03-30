<?php

namespace backend\controllers;

use backend\controllers\BaseCtrl;
use backend\models\ReporteSearch;
use common\models\Distribuidora;
use common\models\Pelicula;
use common\models\Permiso;
use common\models\User;
use kartik\grid\GridView;
use Yii;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;

/**
 * ReporteController implements the CRUD actions for Reporte model.
 */
class ReporteController extends BaseCtrl
{

    public function beforeAction($action)
    {
        if (Yii::$app->user && !Yii::$app->user->isGuest) {
            if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_REPORTES)) {
                throw new HttpException(403, "No tienes los permisos necesarios");
            }
        }
        return parent::beforeAction($action);
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
    public function actionDia()
    {
        $searchModel  = new ReporteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $title   = 'Ventas por dia';
        $url     = 'dia';
        $columns = [
            [
                'attribute'           => 'nombre_pelicula',
                'width'               => '310px',
                //'filterType' => GridView::FILTER_SELECT2,
                'filter'              => ArrayHelper::map(Pelicula::find()->orderBy('nombre')->asArray()->all(), 'id', 'nombre'),
                'filterWidgetOptions' => [
                    //'pluginOptions' => ['allowClear' => true],
                ],
                //'filterInputOptions' => ['placeholder' => 'Any supplier'],
                'group'               => true, // enable grouping
                'groupFooter'         => function ($model, $key, $index, $widget) {
                    if ($model->nombre_pelicula == ReporteSearch::HEADER_TOTALES) {
                        return false;
                    }
                    // Closure method
                    return [
                        'mergeColumns'   => [[0, 6]], // columns to merge in summary
                        'content'        => [ // content to show in each summary cell
                            //0 => $model->nombre_pelicula,
                            7 => GridView::F_SUM,
                            8 => GridView::F_SUM,
                        ],
                        'contentFormats' => [ // content reformatting for each summary cell
                            7 => ['format' => 'number', 'decimals' => 0],
                            8 => ['format' => 'number', 'decimals' => 0],
                        ],
                        'contentOptions' => [ // content html attributes for each summary cell
                            //1 => ['style' => 'text-align:center'],
                            7 => ['style' => 'text-align:right'],
                            8 => ['style' => 'text-align:right'],
                        ],
                        // html attributes for group summary row
                        'options'        => ['class' => 'info table-info', 'style' => 'font-weight:bold;'],
                    ];
                },
            ],
            [
                'attribute'  => 'nombre_distribuidor',
                'label'      => 'Distribuidora',
                'filter'     => ArrayHelper::map(Distribuidora::find()->orderBy('nombre')->asArray()->all(), 'id', 'nombre'),
                'subGroupOf' => 0,
                'group'      => true,
            ],
            // 'fecha:date',
            // 'hora:time',
            [
                'attribute'  => 'fecha',
                'subGroupOf' => 0,
                'group'      => true,
                'format'     => 'date',
            ],
            [
                'attribute' => 'hora',
                'label'     => 'Funcion',
                'format'    => 'time',
            ],
            [
                'label' => 'Sala',
                'value' => function ($m) {
                    if (!empty($m->sala_id)) {
                        return $m->sala->nombre;
                    }
                    return "";
                },
            ],
            ['attribute' => 'nombre', 'label' => 'Tipo'],
            ['attribute' => 'precio', 'label' => 'Precio'],
            ['attribute' => 'conteo', 'label' => 'Entradas'],
            [
                'class'       => '\kartik\grid\DataColumn',
                'attribute'   => 'total',
                'format'      => ['decimal', 0],
                'pageSummary' => true,
            ],
        ];

        $searchTemplate     = '_bdia.php';
        $searchTemplateData = [
            'filterModel' => $searchModel,
            'url'         => $url,
            'usuarios'    => array_column(User::find()->all(), 'username', 'username'),
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
        $title        = 'Boletos por funciones';
        $url          = 'funcion';
        $columns      = [
            [
                'attribute' => 'nombre_pelicula',
                'label'     => 'Pelicula',
                'group'     => true,
            ],
            [
                'attribute'  => 'nombre_distribuidor',
                'label'      => 'Distribuidora',
                'subGroupOf' => 0,
                'group'      => true,
            ],
            [
                'attribute'  => 'fecha',
                'subGroupOf' => 0,
                'group'      => true,
                'format'     => 'date',
            ],
            [
                'attribute' => 'hora',
                'label'     => 'Funcion',
                'format'    => 'time',
            ],
            [
                'label' => 'Sala',
                'value' => function ($m) {
                    if (!empty($m->sala_id)) {
                        return $m->sala->nombre;
                    }
                    return "";
                },
            ],
            ['attribute' => 'nombre', 'label' => 'Tipo'],
            ['attribute' => 'precio', 'label' => 'Precio', 'format' => 'currency'],
            [
                'attribute' => 'conteo',
                'label'     => 'Entradas',
            ],
        ];

        // $usuarios = array_column(User::find()->all(), 'username', 'username');
        $searchTemplate     = '_bfuncion.php';
        $searchTemplateData = [
            'filterModel'    => $searchModel,
            'url'            => $url,
            'distribuidoras' => array_column(Distribuidora::find()->all(), 'nombre', 'nombre'),
            'peliculas'      => array_column(Pelicula::find()->all(), 'nombre', 'nombre'),
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
        $title        = 'Boletos por peliculas';
        $url          = 'pelicula';
        $columns      = [
            [
                'attribute'   => 'nombre_pelicula',
                'label'       => 'Pelicula',
                'group'       => true,
                'groupFooter' => function ($model, $key, $index, $widget) {
                    if ($model->nombre_pelicula == ReporteSearch::HEADER_TOTALES) {
                        return false;
                    }
                    // Closure method
                    return [
                        'mergeColumns'   => [[0, 3]], // columns to merge in summary
                        'content'        => [ // content to show in each summary cell
                            //0 => $model->nombre_pelicula,
                            4 => GridView::F_SUM,
                        ],
                        'contentFormats' => [ // content reformatting for each summary cell
                            4 => ['format' => 'number', 'decimals' => 0],
                        ],
                        'contentOptions' => [ // content html attributes for each summary cell
                            //1 => ['style' => 'text-align:center'],
                            4 => ['style' => 'text-align:right'],
                        ],
                        // html attributes for group summary row
                        'options'        => ['class' => 'info table-info', 'style' => 'font-weight:bold;'],
                    ];
                },
            ],
            [
                'attribute'  => 'nombre_distribuidor',
                'label'      => 'Distribuidora',
                'subGroupOf' => 0,
                'group'      => true,
            ],
            [
                'attribute'  => 'fecha',
                'subGroupOf' => 0,
                'group'      => true,
                'format'     => 'date',
            ],
            //'hora:time',
            ['attribute' => 'nombre', 'label' => 'Tipo'],
            // ['attribute' => 'precio', 'label' => 'Precio', 'format' => 'currency'],
            [
                'attribute' => 'conteo',
                'label'     => 'Entradas',

            ],
            //'total:currency',
        ];

        // $usuarios = array_column(User::find()->all(), 'username', 'username');

        $searchTemplate     = '_bpelicula.php';
        $searchTemplateData = [
            'filterModel' => $searchModel,
            'url'         => $url,
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
        $dataProvider = $searchModel->searchPeriodo(Yii::$app->request->queryParams);
        $title        = 'Ventas por Periodo';
        $url          = 'vperiodo';
        $columns      = [
            [
                'attribute'   => 'nombre_pelicula',
                'label'       => 'Pelicula',
                'group'       => true,
                'groupFooter' => function ($model, $key, $index, $widget) {
                    if ($model->nombre_pelicula == ReporteSearch::HEADER_TOTALES) {
                        return false;
                    }
                    // Closure method
                    return [
                        'mergeColumns'   => [[0, 5]], // columns to merge in summary
                        'content'        => [ // content to show in each summary cell
                            //0 => $model->nombre_pelicula,
                            6 => GridView::F_SUM,
                            7 => GridView::F_SUM,
                        ],
                        'contentFormats' => [ // content reformatting for each summary cell
                            6 => ['format' => 'number', 'decimals' => 0],
                            7 => ['format' => 'number', 'decimals' => 0],
                        ],
                        'contentOptions' => [ // content html attributes for each summary cell
                            //1 => ['style' => 'text-align:center'],
                            6 => ['style' => 'text-align:right'],
                            7 => ['style' => 'text-align:right'],
                        ],
                        // html attributes for group summary row
                        'options'        => ['class' => 'info table-info', 'style' => 'font-weight:bold;'],
                    ];
                },
            ],
            [
                'attribute'  => 'nombre_distribuidor',
                'label'      => 'Distribuidora',
                'subGroupOf' => 0,
                'group'      => true,
            ],
            [
                'attribute' => 'fecha',
                'format'    => 'date',
            ],
            [
                'attribute' => 'hora',
                'label'     => 'Funcion',
                'format'    => 'time',
            ],
            [
                'label' => 'Sala',
                'value' => function ($m) {
                    if (!empty($m->sala_id)) {
                        return $m->sala->nombre;
                    }
                    return "";
                },
            ],
            ['attribute' => 'nombre', 'label' => 'Tipo'],
            ['attribute' => 'precio', 'label' => 'Precio', 'format' => ['decimal', 2]],
            [
                'attribute' => 'total',
                'label'     => 'Total',
            ],
        ];

        // $usuarios = array_column(User::find()->all(), 'username', 'username');
        $searchTemplate     = '_bperiodo.php';
        $searchTemplateData = [
            'filterModel'    => $searchModel,
            'url'            => $url,
            'distribuidoras' => array_column(Distribuidora::find()->all(), 'nombre', 'nombre'),
            'peliculas'      => array_column(Pelicula::find()->all(), 'nombre', 'nombre'),
            'usuarios'       => array_column(User::find()->all(), 'username', 'username'),
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
        $dataProvider = $searchModel->searchPeriodo(Yii::$app->request->queryParams);
        $title        = 'Boletos por Periodo';
        $url          = 'bperiodo';
        $columns      = [
            [
                'attribute'   => 'fecha_venta',
                'format'      => 'date',
                'group'       => true,
                'groupFooter' => function ($model, $key, $index, $widget) {
                    if ($model->nombre_pelicula == ReporteSearch::HEADER_TOTALES) {
                        return false;
                    }
                    // Closure method
                    return [
                        'mergeColumns'   => [[0, 6]], // columns to merge in summary
                        'content'        => [ // content to show in each summary cell
                            //0 => $model->nombre_pelicula,
                            7 => GridView::F_SUM,
                            8 => GridView::F_SUM,
                        ],
                        'contentFormats' => [ // content reformatting for each summary cell
                            7 => ['format' => 'number', 'decimals' => 0],
                            8 => ['format' => 'number', 'decimals' => 0],
                        ],
                        'contentOptions' => [ // content html attributes for each summary cell
                            //1 => ['style' => 'text-align:center'],
                            7 => ['style' => 'text-align:right'],
                            8 => ['style' => 'text-align:right'],
                        ],
                        // html attributes for group summary row
                        'options'        => ['class' => 'info table-info', 'style' => 'font-weight:bold;'],
                    ];
                },
            ],
            [
                'attribute'   => 'nombre_pelicula',
                'label'       => 'Pelicula',
                'subGroupOf'  => 0,
                'group'       => true,
                'groupFooter' => function ($model, $key, $index, $widget) {
                    if ($model->nombre_pelicula == ReporteSearch::HEADER_TOTALES) {
                        return false;
                    }
                    // Closure method
                    return [
                        'mergeColumns'   => [[1, 6]], // columns to merge in summary
                        'content'        => [ // content to show in each summary cell
                            7 => GridView::F_SUM,
                            8 => GridView::F_SUM,
                        ],
                        'contentFormats' => [ // content reformatting for each summary cell
                            7 => ['format' => 'number', 'decimals' => 0],
                            8 => ['format' => 'number', 'decimals' => 0],
                        ],
                        'contentOptions' => [ // content html attributes for each summary cell
                            7 => ['style' => 'text-align:right'],
                            8 => ['style' => 'text-align:right'],
                        ],
                        // html attributes for group summary row
                        'options'        => ['class' => 'info table-info', 'style' => 'font-weight:bold;'],
                    ];
                },
            ],
            [
                'attribute' => 'nombre_distribuidor',
                'label'     => 'Distribuidora',
            ],
            [
                'attribute' => 'fecha',
                'format'    => 'date',
            ],
            [
                'attribute' => 'hora',
                'label'     => 'Funcion',
                'format'    => 'time',
            ],
            [
                'label' => 'Sala',
                'value' => function ($m) {
                    if (!empty($m->sala_id)) {
                        return $m->sala->nombre;
                    }
                    return "";
                },
            ],
            ['attribute' => 'nombre', 'label' => 'Tipo'],
            ['attribute' => 'precio', 'label' => 'Precio', 'format' => ['decimal', 2]],
            [
                'attribute'   => 'conteo',
                'label'       => 'Entradas',
                'pageSummary' => true,
            ],
        ];
        $searchTemplate     = '_bperiodo.php';
        $searchTemplateData = [
            'filterModel'    => $searchModel,
            'url'            => $url,
            'distribuidoras' => array_column(Distribuidora::find()->all(), 'nombre', 'nombre'),
            'peliculas'      => array_column(Pelicula::find()->all(), 'nombre', 'nombre'),
            'usuarios'       => array_column(User::find()->all(), 'username', 'username'),
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
                'title'              => $title,
                'url'                => $url,
                'searchTemplate'     => $searchTemplate,
                'searchTemplateData' => $searchTemplateData,
                'filterModel'        => $searchModel,
                'showPageSummary'    => true,
                'widgetData'         => [
                    'export'       => [
                        'label' => 'Exportar reporte',
                    ],
                    'exportConfig' => [
                        GridView::HTML => [],
                        GridView::PDF  => [
                            'filename' => $title,
                            'config'   => [
                                'mode'        => 'utf-8',
                                'format'      => 'Letter',
                                'destination' => 'D',
                                'methods'     => [
                                    'SetHeader' => [$title],
                                    'SetFooter' => ['{PAGENO}'],
                                ],
                            ],
                        ],
                    ],
                    'dataProvider' => $dataProvider,
                    'filterModel'  => $searchModel,
                    'rowOptions'   => function ($m) {
                        return ($m->nombre_pelicula == ReporteSearch::HEADER_TOTALES) ? ['style' => 'font-weight: 700'] : [];
                    },
                    'toolbar'      => [
                        '{export}',
                        '{toggleData}',
                    ],
                    'panel'        => [
                        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> ' . $title . '</h3>',
                        'type'    => 'success',
                        'after'   => '{pager}' . '<br>' . Html::a('<i class="fas fa-redo skip-export"></i> Reiniciar filtros', [$url], ['class' => 'btn btn-info']),
                        'footer'  => false,
                    ],
                    'columns'      => $columns,
                ],
            ]
        );
    }
}
