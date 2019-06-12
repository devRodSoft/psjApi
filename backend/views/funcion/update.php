<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Funcion */

$this->title                   = 'Actualizar Funcion: ' . $model->pelicula->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Funcions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="funcion-update">

    <h1>Actualizar Funcion: <?php echo Html::a(Html::encode($model->pelicula->nombre), ['pelicula/view', 'id' => $model->id]) ?></h1>

    <?php echo $this->render('_form', [
    'model' => $model,
    'hrs' => $hrs,
]) ?>

</div>
