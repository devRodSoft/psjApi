<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PeliculaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelicula-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]);?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'nombre') ?>

    <?php echo $form->field($model, 'distribuidora_id') ?>

    <?php echo $form->field($model, 'genero') ?>

    <?php echo $form->field($model, 'calificacion') ?>

    <?php // echo $form->field($model, 'clasificacion') ?>

    <?php // echo $form->field($model, 'idioma') ?>

    <?php // echo $form->field($model, 'duracion') ?>

    <?php // echo $form->field($model, 'sinopsis') ?>

    <?php // echo $form->field($model, 'cartelUrl') ?>

    <?php // echo $form->field($model, 'trailerUrl') ?>

    <?php // echo $form->field($model, 'trailerImg') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end();?>

</div>
