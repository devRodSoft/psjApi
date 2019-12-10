<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div>
    <?php
$form = ActiveForm::begin(
    [
        'action' => [$url],
        'method' => 'get',
    ]
);
?>

    <p>
        <?php echo $form->field($filterModel, 'fechaInicio')->widget(
    DatePicker::className(),
    [
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        ],
    ]
); ?>
        <?php echo $form->field($filterModel, 'fechaFin')->widget(
    DatePicker::className(),
    [
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        ],
    ]
); ?>

        <?php echo $form->field($filterModel, 'nombre_pelicula')->widget(
    Select2::classname(),
    [
        'data' => $peliculas,
        'options' => ['placeholder' => 'Selecciona una pelicula ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]
); ?>

        <?php echo $form->field($filterModel, 'username')->widget(
    Select2::classname(),
    [
        'data' => $usuarios,
        'options' => ['placeholder' => 'Selecciona un Usuario ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]
); ?>

        <?php echo $form->field($filterModel, 'nombre_distribuidor')->widget(
    Select2::classname(),
    [
        'data' => $distribuidoras,
        'options' => ['placeholder' => 'Selecciona una distribuidora ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]
); ?>
    </p>


    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::resetButton('Reset', ['class' => 'btn btn-default'])
?>
    </div>

    <?php ActiveForm::end();?>

</div>
