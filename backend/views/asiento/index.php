<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AsientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Asientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asiento-index">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Crear Asiento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'nombre',
        'fila',
        'numero',
        [
            'label' => 'tipo',
            'value' => function ($m) {
                return [0 => 'Pasillo', 1 => 'Asiento', 2 => 'Silla de ruedas'][$m->tipo];
            }],

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
</div>
