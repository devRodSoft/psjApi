<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Pelicula */

$this->title = 'Crear Pelicula';
$this->params['breadcrumbs'][] = ['label' => 'Peliculas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelicula-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
