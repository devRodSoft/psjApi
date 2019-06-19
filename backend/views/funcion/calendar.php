<?php

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FuncionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;

$this->title                   = 'Calendar ' . $info->nombre;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funcion-index">
  <h1><?php echo Html::encode($info->nombre) ?></h1>
  <p>
    <span>Primera fecha: <strong><?php echo Html::encode($fechas['max']) ?></strong></span><br>
    <span>Ultima fecha: <strong><?php echo Html::encode($fechas['min']) ?></strong></span>
  </p>
  <p>
      <?php echo Html::a('Crear Función', ['create'], ['class' => 'btn btn-success']) ?>
      <?php echo Html::a('Ver Planner', ['funcion/planner'], ['class' => 'btn btn-primary']) ?>
      <?php echo Html::a('ver Listado', ['index'], ['class' => 'btn btn-primary']) ?>
  </p>
  <hr>
  <div id='calendar'></div>
</div>

<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'timeGrid', 'interaction' ],
      defaultView: 'timeGridWeek',
      forceEventDuration:true,
      locale: 'es',
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


    calendar.render();

});

</script>
