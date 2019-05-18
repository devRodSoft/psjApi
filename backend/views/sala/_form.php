<?php

use common\models\Cine;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Sala */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sala-form">

    <?php $form = ActiveForm::begin();?>

    <?php echo $form->field($model, 'cine_id')->dropDownList(array_column(Cine::Find()->All(), 'nombre', 'id'), ['prompt' => 'selecciona un cine']) ?>

    <?php echo $form->field($model, 'nombre')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php echo $this->render('_asientos_edit', [
    'model' => $model,
]) ?>

    <?php ActiveForm::end();?>

</div>
