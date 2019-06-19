<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Estreno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estreno-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cine_id')->textInput() ?>

    <?= $form->field($model, 'pelicula_id')->textInput() ?>

    <?= $form->field($model, 'inicio')->textInput() ?>

    <?= $form->field($model, 'fin')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'publicar')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
