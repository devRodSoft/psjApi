<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReporteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Reportes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reporte-index">

    <h1><?=Html::encode($this->title)?></h1>

    <p class="col-md-12">
        <?=Html::a('1 - VENTAS P/ DIA:', ['dia'], ['class' => 'btn btn-primary col-md-4'])?>
    </p>
    <p class="col-md-12">
        <?=Html::a('2 - BOLETOS P/ FUNCIONES:', ['funcion'], ['class' => 'btn btn-primary col-md-4'])?>
    </p>
    <p class="col-md-12">
        <?=Html::a('3 - BOLETOS P/ PELICULAS:', ['pelicula'], ['class' => 'btn btn-primary col-md-4'])?>
    </p>
    <p class="col-md-12">
        <?=Html::a('4 - VENTAS P/ PERIODO:', ['vperiodo'], ['class' => 'btn btn-primary col-md-4'])?>
    </p>
    <p class="col-md-12">
        <?=Html::a('5 - BOLETOS POR PERIODO:', ['bperiodo'], ['class' => 'btn btn-primary col-md-4'])?>
    </p>
    <p class="col-md-12">
        <?=Html::a('6 - BOLETOS POR CANCELADOS:', ['cancelados'], ['class' => 'btn btn-primary col-md-4'])?>
    </p>
</div>
