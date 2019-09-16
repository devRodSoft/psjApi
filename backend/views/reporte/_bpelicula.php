<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
?>
<div>
    <?php
    $form = ActiveForm::begin(
        [
            'action' => [strtolower($title)],
            'method' => 'get',
        ]
    );
    ?>

    <p>
        <?php echo $form->field($filterModel, 'fechaInicio')->widget(
            DateTimePicker::className(),
            [
                'removeButton' => false,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii'
                ]
            ]
        ); ?>
        <?php echo $form->field($filterModel, 'fechaFin')->widget(
            DateTimePicker::className(),
            [
                'removeButton' => false,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii'
                ]
            ]
        ); ?>

        <?php  /*echo $form->field($filterModel, 'username')->widget(
            Select2::classname(),
            [
                'data' => $usuarios,
                'options' => ['placeholder' => 'Selecciona un Usuario ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]
        ); */ ?>

    </p>


    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::resetButton('Reset', ['class' => 'btn btn-default'])
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
