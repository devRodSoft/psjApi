<?php

use common\models\Role;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin();?>

    <?php echo $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'password')->textInput(['maxlength' => true]) ?>


    <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'role_id')->dropDownList(array_column(Role::Find()->All(), 'nombre', 'id'), ['prompt' => 'selecciona un rol']) ?>

    <?php echo $form->field($model, 'status')->dropDownList([User::STATUS_DELETED => 'Borrard', User::STATUS_ACTIVE => 'Active'], ['prompt' => 'selecciona un estatus']) ?>

    <div class="form-group">
        <?php echo Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end();?>

</div>
