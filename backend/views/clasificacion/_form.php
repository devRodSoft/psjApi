<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Clasificacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clasificacion-form">

    <?php $form = ActiveForm::begin();?>

    <?php echo $form->field($model, 'nombre')->textInput()?>

    <?php echo $form->field($model, 'orden')->textInput(['type' => 'number'])?>

    <div class="form-group">
        <?php echo Html::submitButton('Save', ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
