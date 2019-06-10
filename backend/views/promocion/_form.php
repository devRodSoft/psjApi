<?php

use common\models\Cine;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Promocion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promocion-form">

    <?php $form = ActiveForm::begin();?>

    <?php //echo $form->field($model, 'cine_id')->textInput() ?>
    <?php echo $form->field($model, 'cine_id')->dropDownList(array_column(Cine::Find()->All(), 'nombre', 'id'), ['prompt' => 'selecciona un cine']) ?>

    <?php echo $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'bases')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'image_url')->textarea(['rows' => 6]) ?>

    <?php // echo $form->field($model, 'start_date')->textInput() ?>

    <?php // echo $form->field($model, 'end_date')->textInput() ?>

    <?php echo $form->field($model, 'start_date')->textInput(['type' => 'date', 'value' => date('Y-m-d', strtotime($model->start_date))]) ?>

    <?php echo $form->field($model, 'end_date')->textInput(['type' => 'date', 'value' => date('Y-m-d', strtotime($model->end_date)), 'min' => date('Y-m-d')]) ?>

    <?php //echo $form->field($model, 'created_at')->textInput()?>

    <?php //echo $form->field($model, 'updated_at')->textInput()?>

    <div class="form-group">
        <?php echo Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end();?>

</div>
