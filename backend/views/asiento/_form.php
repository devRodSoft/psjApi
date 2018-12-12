<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Asiento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asiento-form">

    <?php $form = ActiveForm::begin();?>

    <?php echo $form->field($model, 'fila')->textInput(['maxlength' => true]) ?>
    <?php echo $form->field($model, 'numero')->textInput() ?>

    <?php echo $form->field($model, 'tipo')->dropDownList([0 => 'Pasillo', 1 => 'Asiento', 2 => 'Silla de ruedas'], ['prompt' => 'selecciona un tipo']) ?> ?>

    <?php echo $form->field($model, 'arreglo')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php echo Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end();?>

</div>
