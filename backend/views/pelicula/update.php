<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pelicula */

$this->title                   = 'Actualizar Pelicula: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Peliculas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="pelicula-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
    'model' => $model,
    'clasificaciones' => $clasificaciones,
    'distribuidoras' => $distribuidoras,
]) ?>

</div>
