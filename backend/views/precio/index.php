<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PrecioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Precios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="precio-index">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <?php Pjax::begin();?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Crear Precio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'codigo',
        'nombre',
        'default',
        'especial',

        [
            'class' => 'yii\grid\ActionColumn',
            'visible' => Yii::$app->user->isGuest ? false : true,
            'template' => '{view} {update}',
        ],
    ],
]); ?>
    <?php Pjax::end();?>
</div>
