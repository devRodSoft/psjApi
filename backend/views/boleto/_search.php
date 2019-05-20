<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BoletoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="boleto-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]);?>

    <?php echo $form->field($model, 'id')?>

    <?php echo $form->field($model, 'face_user_id')?>

    <?php echo $form->field($model, 'horario_funcion_id')?>

    <?php echo $form->field($model, 'reclamado')?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary'])?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
