<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Funcion */

$this->title                   = $model->pelicula->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Funcions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="funcion-view">

    <h1><?php echo Html::a(Html::encode($model->pelicula->nombre), ['funcion/calendar', 'id' => $model->pelicula_id]) ?></h1>

    <p>
        <?php echo Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Borrar', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => 'Estas seguro que quieres eliminar este elemento?',
        'method' => 'post',
    ],
]) ?>
    </p>

    <?php echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        [
            'label' => 'cine',
            'value' => function ($m) {
                return $m->cine->nombre;
            }],
        [
            'label' => 'pelicula',
            'value' => function ($m) {
                return $m->pelicula->nombre;
            }],
        'publicar:boolean',
        'fecha',
        'hora',
    ],
]) ?>

<h2>Precios</h2>
<table id="myTable" class="table table-striped table-bordered detail-view">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Código</th>
                <th>Precio</th>
                <th>Usando especial</th>


            </tr>
        </thead>
        <tbody>
            <?php foreach ($model->horarioPrecios as $horarioPrecio): ?>
            <tr>
                <td><?php echo $horarioPrecio->precio->nombre ?></td>
                <td><?php echo $horarioPrecio->precio->codigo ?></td>
                <td><?php echo ($horarioPrecio->usar_especial) ? $horarioPrecio->precio->especial : $horarioPrecio->precio->default ?></td>
                <td><?php echo ($horarioPrecio->usar_especial) ? 'si' : 'no' ?></td>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>

<!-- <table id="myTable" class=" table order-list">
        <thead>
            <tr>
                <td>Fecha</td>
                <td>Hora</td>
                <td>Sala</td>

            </tr>
        </thead>
        <tbody>
            <?php // foreach ($model->horarios as $key => $horario): ?>
            <tr>
                <td>
                    <?php // echo $horario->fecha ?>
                </td>
                <td>
                    <?php // echo Yii::$app->formatter->asTime($horario->hora, 'php:H:i'); ?>
                </td>
                <td>
                    <?php // echo $horario->sala->nombre ?>
                </td>
            </tr>
            <?php // endforeach?>
        </tbody>
    </table> -->

</div>
<!--
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'list' ],
          defaultView: 'listMonth',
          forceEventDuration:true,
          defaultTimedEventDuration:{years: 0, months: 0, days: 0, milliseconds:<?php echo $model->pelicula->duracion * 60000 ?>},
          events: <?php echo json_encode($hrs) ?>,

        });

        calendar.render();
      });

</script>
<div id="calendar"></div> -->
