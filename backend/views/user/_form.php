<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin();?>

    <?php echo $form->field($model, 'username')->textInput(['maxlength' => true])?>

    <?php echo $form->field($model, 'password')->textInput(['maxlength' => true])?>


    <?php echo $form->field($model, 'email')->textInput(['maxlength' => true])?>

    <?php echo $form->field($model, 'role_id')->textInput()?>

    <?php echo $form->field($model, 'status')->textInput()?>

    <div class="form-group">
        <?php echo Html::submitButton('Save', ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
