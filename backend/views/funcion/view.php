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

    <h1><?php echo Html::a(Html::encode($model->pelicula->nombre), ['pelicula/view', 'id' => $model->id]) ?></h1>

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
        'cine.nombre',
        'pelicula.nombre',
        'precio:currency',
        'precio_niños:currency',
        'estreno_inicio',
        'estreno_fin',
        'publicar:boolean',
        'created_at',
        'updated_at',
    ],
]) ?>

<!-- <table id="myTable" class=" table order-list">
        <thead>
            <tr>
                <td>Fecha</td>
                <td>Hora</td>
                <td>Sala</td>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($model->horarios as $key => $horario): ?>
            <tr>
                <td>
                    <?php echo $horario->fecha ?>
                </td>
                <td>
                    <?php echo Yii::$app->formatter->asTime($horario->hora, 'php:H:i'); ?>
                </td>
                <td>
                    <?php echo $horario->sala->nombre ?>
                </td>
            </tr>
            <?php endforeach?>
        </tbody>
    </table> -->

</div>

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
<div id="calendar"></div>
