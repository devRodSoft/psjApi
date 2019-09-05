<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pelicula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelicula-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'genero')->dropDownList($generos, ['prompt' => 'Genero']) ?>

    <?php // Usage with ActiveForm and model
    echo $form->field($model, 'distribuidora_id')->widget(
        Select2::classname(),
        [
            'data' => $distribuidoras,
            'options' => ['placeholder' => 'Selecciona una distribuidora ...'],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ]
    ); ?>

    <?php echo $form->field($model, 'clasificacion')->dropDownList($clasificaciones, ['prompt' => 'clasificación']) ?>

    <?php echo $form->field($model, 'idioma')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'duracion')->textInput(['type' => 'number', "placeholder" => "120", "min" => "30", "step" => "5"]) ?>

    <?php echo $form->field($model, 'sinopsis')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'trailerUrl')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'imageFile')->widget(
        FileInput::classname(),
        [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview' => [$model->cartelUrl],
                'initialPreviewAsData' => true,
                'overwriteInitial' => true,
                'showCaption' => true,
                'showRemove' => false,
                'showUpload' => false
            ]
        ]
    ); ?>


    <div class="form-group">
        <?php echo Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
