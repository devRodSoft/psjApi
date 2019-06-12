<?php

use backend\assets\AppAsset;
use common\models\Cine;
use common\models\Pelicula;
use common\models\Sala;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Funcion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="funcion-form">

    <?php $form = ActiveForm::begin();?>

    <?php echo $form->field($model, 'cine_id')->dropDownList(array_column(Cine::Find()->All(), 'nombre', 'id'), ['prompt' => 'selecciona un cine']) ?>

    <?php echo $form->field($model, 'pelicula_id')->dropDownList(array_column(Pelicula::Find()->All(), 'nombre', 'id'), ['prompt' => 'selecciona una pelicula', 'class' => 'form-control']) ?>

    <?php echo $form->field($model, 'precio')->textInput(['maxlength' => true, 'type' => 'number']) ?>
    <?php echo $form->field($model, 'precio_niños')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <?php echo $form->field($model, 'estreno_inicio')->textInput(['type' => 'date', 'value' => date('Y-m-d', strtotime($model->estreno_inicio))]) ?>
    <?php echo $form->field($model, 'estreno_fin')->textInput(['type' => 'date', 'value' => date('Y-m-d', strtotime($model->estreno_fin)), 'min' => date('Y-m-d')]) ?>

    <?php echo $form->field($model, 'publicar')->checkbox() ?>

    <div class="alert alert-warning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">precaucion:</span>
        Despues de guardar una funcion con horarios para el dia de hoy o el dia de mañana, estos no seran editables.
    </div>

    <table id="myTable" class=" table order-list">
        <thead>
            <tr>
                <td>Fecha</td>
                <td>Hora</td>
                <td>Sala</td>

            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="text - align:left;">
                    <input type="button" class="btn btn-lg btn-block" id="addrow" value="Agregar horario" />
                </td>
            </tr>
            <tr>
            </tr>
        </tfoot>
    </table>


    <div class="form - group">
        <?php echo Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end();?>

</div>

<?php
$this->registerJs(
    "$(document).ready(function () {
    var counter = $('table.order-list tbody tr').length;
    $('#addrow').on('click', function () {
        var newRow = $('<tr>');
        var cols   = '';

        cols += '<td><input type=\"date\" class=\"form-control\" name=\"horario['+counter+'][fecha]\" min=\"" . date("Y-m-d") . "\" pattern=\"[0-9]{4}-[0-9]{2}-[0-9]{2}\"/></td>';
        cols += '<td><input type=\"time\" class=\"form-control\" name=\"horario['+counter+'][hora]\"/></td>';
        cols += '<td>" . str_replace(["\n", 'counter'], ['', "'+counter+'"], Html::dropDownList('horario[counter][sala]', "", array_column(Sala::Find()->All(), 'nombre', 'id'), ['prompt' => 'selecciona una sala', 'class' => 'form-control'])) . "</td>';

        cols += '<td><input type=\"button\" class=\"ibtnDel btn btn-md btn-danger\"  value=\"Borrar\"></td>';
        newRow.append(cols);
        $('table.order-list').append(newRow);
        counter++
    });

    $('table.order-list').on('click', '.ibtnDel', function (event) {
        $(this).closest('tr').remove();
        counter -= 1;
    });
});",
    \yii\web\View::POS_READY,
    'my-button-handler'
);
?>



<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'timeGrid', 'interaction' ],
      defaultView: 'timeGridWeek',
      forceEventDuration:true,
      defaultTimedEventDuration:{years: 0, months: 0, days: 0, milliseconds:<?php echo ((!is_null($model->pelicula_id)) ? $model->pelicula->duracion : 60) * 60000 ?>},
      events: <?php echo json_encode($hrs); ?>,
      dateClick: function(info) {
          // alert('Clicked on: ' + info.dateStr);
          // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
          // alert('Current view: ' + info.view.type);
          // change the day's background color just for fun
          info.dayEl.style.backgroundColor = 'red';
        },
      select: function(info) {
          // alert('Clicked on: ' + info.dateStr);
          // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
          // alert('Current view: ' + info.view.type);
          // change the day's background color just for fun
          info.dayEl.style.backgroundColor = 'red';
        }
    });
    debugger

    calendar.render();

});

</script>

<div id='calendar'></div>
