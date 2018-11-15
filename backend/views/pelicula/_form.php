<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pelicula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelicula-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'genero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calificacion')->dropDownList([1,2,3,4,5], ['prompt' => 'calificación']) ?>

    <?= $form->field($model, 'clasificacion')->dropDownList(['AA', 'A', 'B', 'B15', 'C', 'D'], ['prompt' => 'clasificación']) ?>

    <?= $form->field($model, 'idioma')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'duracion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sinopsis')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cartelUrl')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'trailerUrl')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'trailerImg')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
