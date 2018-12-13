<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Boleto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="boleto-form">

    <?php $form = ActiveForm::begin();?>

    <?php //echo $form->field($model, 'face_user_id')->textInput() ?>

    <?php //echo $form->field($model, 'horario_funcion_id')->textInput() ?>

    <?php echo $form->field($model, 'sala_asientos_id')->dropDownList($asientos, ['prompt' => 'selecciona un asiento', 'class' => 'form-control']) ?>

    <?php echo $form->field($model, 'reclamado')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end();?>

</div>
