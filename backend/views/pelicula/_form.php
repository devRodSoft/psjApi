<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pelicula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelicula-form">

    <?php $form = ActiveForm::begin();?>

    <?php echo $form->field($model, 'nombre')->textInput(['maxlength' => true])?>

    <?php echo $form->field($model, 'director')->textarea(['rows' => 6])?>

    <?php echo $form->field($model, 'genero')->textarea(['rows' => 6])?>

    <?php echo $form->field($model, 'calificacion')->textInput(['maxlength' => true])?>

    <?php echo $form->field($model, 'clasificacion')->textarea(['rows' => 6])?>

    <?php echo $form->field($model, 'idioma')->textarea(['rows' => 6])?>

    <?php echo $form->field($model, 'duracion')->textarea(['rows' => 6])?>

    <?php echo $form->field($model, 'sinopsis')->textarea(['rows' => 6])?>

    <?php echo $form->field($model, 'cartelUrl')->textarea(['rows' => 6])?>

    <?php echo $form->field($model, 'trailerUrl')->textarea(['rows' => 6])?>

    <?php echo $form->field($model, 'trailerImg')->textarea(['rows' => 6])?>

    <?php echo $form->field($model, 'created_at')->textInput()?>

    <?php echo $form->field($model, 'updated_at')->textInput()?>

    <div class="form-group">
        <?php echo Html::submitButton('Save', ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
