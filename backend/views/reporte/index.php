<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReporteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reportes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reporte-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="col-md-12">
        <?= Html::a('Reporte general', ['general'], ['class' => 'btn btn-primary col-md-4']) ?>
    </p>
    <p class="col-md-12">
        <?= Html::a('Reporte por usuarios', ['usuarios'], ['class' => 'btn btn-primary col-md-4']) ?>
    </p>
    <p class="col-md-12">
        <?= Html::a('Reporte por pelicula', ['pelicula'], ['class' => 'btn btn-primary col-md-4']) ?>
    </p>
    <p class="col-md-12">
        <?= Html::a('Reporte por distribuidor', ['distribuidor'], ['class' => 'btn btn-primary col-md-4']) ?>
    </p>
</div>
