<?php

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FuncionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;

$this->title                   = 'Funciones';
$this->params['breadcrumbs'][] = $this->title;
?>
  <p>
      <?php echo Html::a('Crear Función', ['create'], ['class' => 'btn btn-success']) ?>
      <?php echo Html::a('Ver Listado', ['index'], ['class' => 'btn btn-primary']) ?>
  </p>
    <p>
      <?php echo Html::a('mostrar todas las funciones', ['planner', 'all' => true], ['class' => 'btn btn-primary pull-right']) ?>
    </p>
<div class="funcion-index">
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
