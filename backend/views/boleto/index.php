<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BoletoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Boletos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boleto-index">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'faceUser.username',
        'horarioFuncion.fecha',
        'horarioFuncion.hora',
        'salaAsientos.asiento.nombre',
        'reclamado:boolean',
        //'created_at',
        //'updated_at',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
</div>
