<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClasificacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clasificaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <p>
        <?= Html::a('Create Clasificacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre:ntext',
            'orden',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
