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

    <?= $form->field($model, 'genero')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'calificacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clasificacion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'idioma')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'duracion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sinopsis')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cartelUrl')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'trailerUrl')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'trailerImg')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
