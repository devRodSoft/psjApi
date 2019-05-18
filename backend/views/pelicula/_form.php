<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pelicula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelicula-form">

    <?php $form = ActiveForm::begin();?>

    <?php echo $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'genero')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'calificacion')->textInput(['type' => 'number', "placeholder" => "0.0", "min" => "0", "max" => "5", "step" => "0.5"]) ?>

    <?php echo $form->field($model, 'distribuidora_id')->dropDownList($distribuidoras, ['prompt' => 'Distribuidora']) ?>

    <?php echo $form->field($model, 'clasificacion')->dropDownList($clasificaciones, ['prompt' => 'clasificación']) ?>

    <?php echo $form->field($model, 'idioma')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'duracion')->textInput(['type' => 'number', "placeholder" => "120", "min" => "30", "step" => "5"]) ?>

    <?php echo $form->field($model, 'sinopsis')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'cartelUrl')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'trailerUrl')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?php echo Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end();?>

</div>
