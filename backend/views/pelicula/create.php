<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pelicula */

$this->title                   = 'Crear Pelicula';
$this->params['breadcrumbs'][] = ['label' => 'Peliculas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelicula-create">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
    'model' => $model,
    'clasificaciones' => $clasificaciones,
    'distribuidoras' => $distribuidoras,
]) ?>

</div>
