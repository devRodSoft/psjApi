<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FuncionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Funciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funcion-index">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Crear Función', ['create'], ['class' => 'btn btn-success']) ?>
        <?php echo Html::a('Ver Planner', ['planner'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'cine.nombre',
        'pelicula.nombre',

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {calendar} {update}',
            'buttons' => [
                'calendar' => function ($url, $model, $index) {
                    $urlc = ['funcion/calendar', 'id' => $model->pelicula_id];
                    return Html::a('<span class="glyphicon glyphicon-calendar"></span>',
                        $urlc, [
                            'title' => 'calendar',
                            'data-pjax' => '0',
                        ]);
                },
            ],
        ],
    ],
]); ?>
</div>


