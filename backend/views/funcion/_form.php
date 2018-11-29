<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Cine;
use common\models\Pelicula;
use common\models\Sala;

/* @var $this yii\web\View */
/* @var $model common\models\Funcion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="funcion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cine_id')->dropDownList(array_column(Cine::Find()->All(), 'nombre', 'id'), ['prompt' => 'selecciona un cine']) ?>

    <?= $form->field($model, 'pelicula_id')->dropDownList(array_column(Pelicula::Find()->All(), 'nombre', 'id'), ['prompt' => 'selecciona una pelicula']) ?>
    <?= $form->field($model, 'sala_id')->dropDownList(array_column(Sala::Find()->All(), 'nombre', 'id'), ['prompt' => 'selecciona una pelicula']) ?>

    <?= $form->field($model, 'precio')->textInput(['maxlength' => true, 'type'=> 'number']) ?>

    <?= $form->field($model, 'recomendada')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
