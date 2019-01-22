<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FuncionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="funcion-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]);?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'cine_id') ?>

    <?php echo $form->field($model, 'pelicula_id') ?>

    <?php echo $form->field($model, 'sala_id') ?>

    <?php echo $form->field($model, 'precio') ?>

    <?php echo $form->field($model, 'precio_niños') ?>

    <?php // echo $form->field($model, 'recomendada') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end();?>

</div>
