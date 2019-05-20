<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DistribuidoraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Distribuidoras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distribuidora-index">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Distribuidora', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        // 'id',
        'nombre',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
</div>
