<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Cine;
use common\models\Pelicula;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Estreno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estreno-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'cine_id')->dropDownList(array_column(Cine::Find()->All(), 'nombre', 'id'), ['prompt' => 'selecciona un cine']) ?>

    <?php //echo $form->field($model, 'pelicula_id')->dropDownList(array_column(Pelicula::Find()->All(), 'nombre', 'id'), ['prompt' => 'selecciona una pelicula'])
    ?>

    <?php // Usage with ActiveForm and model
    echo $form->field($model, 'pelicula_id')->widget(
        Select2::classname(),
        [
            'data' => array_column(Pelicula::Find()->orderBy('id DESC')->All(), 'nombre', 'id'),
            'options' => ['placeholder' => 'Selecciona una pelicula ...'],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ]
    ); ?>

    <?php
    echo $form->field($model, 'inicio')->widget(
        DateTimePicker::className(),
        [
            'language' => 'es',
            'size' => 'sm',
            'removeButton' => false,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd hh:ii',
                'startDate' => date("Y-m-d h:i"),
            ],
        ]
    );

    echo $form->field($model, 'fin')->widget(
        DateTimePicker::className(),
        [
            'language' => 'es',
            'size' => 'sm',
            'removeButton' => false,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd hh:ii',
                'startDate' => date("Y-m-d h:i"),
            ],
        ]
    );
    ?>

    <?php echo $form->field($model, 'publicar')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
