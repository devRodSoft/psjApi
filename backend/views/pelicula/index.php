<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PeliculaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Peliculas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelicula-index">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Crear Pelicula', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        // 'id',
        'nombre',
        [
            'label' => 'Distribuidor',
            'value' => function ($model) {
                return $model->distribuidora->nombre;
            },
        ],
        [
            'label' => 'Genero',
            'value' => function ($model) {
                return join(', ', array_column($model->genero,'nombre'));
            },
        ],
        'clasificacion:ntext',
        'idioma:ntext',
        //'duracion:ntext',
        //'sinopsis:ntext',
        //'cartelUrl:ntext',
        //'trailerUrl:ntext',
        //'trailerImg:ntext',
        //'created_at',
        //'updated_at',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
</div>
