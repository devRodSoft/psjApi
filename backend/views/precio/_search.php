<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PrecioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="precio-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1,
    ],
]);?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'codigo') ?>

    <?php echo $form->field($model, 'nombre') ?>

    <?php echo $form->field($model, 'default') ?>

    <?php echo $form->field($model, 'especial') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end();?>

</div>
