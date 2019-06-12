<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Precio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="precio-form">

    <?php $form = ActiveForm::begin();?>

    <?php echo $form->field($model, 'nombre')->textInput(['maxlength' => true, 'max' => 45]) ?>

    <?php echo $form->field($model, 'default')->textInput(['type' => 'number', 'maxlength' => true, 'min' => 0, 'step' => 0.5]) ?>

    <?php echo $form->field($model, 'especial')->textInput(['type' => 'number', 'maxlength' => true, 'min' => 0, 'step' => 0.5]) ?>

    <div class="form-group">
        <?php echo Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end();?>

</div>
