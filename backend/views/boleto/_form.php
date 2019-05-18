<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;?>

    <?php //echo $form->field($model, 'face_user_id')->textInput() ?>

    <?php //echo $form->field($model, 'horario_funcion_id')->textInput() ?>

    <?php
echo Select2::widget([
    'name' => 'asientos_dat',
    'data' => $asientos,
    'options' => [
        'placeholder' => 'Selecciona asientos',
        'multiple' => true,
    ],
]);

?>

    <?php echo $form->field($model, 'reclamado')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end();?>

</div>
