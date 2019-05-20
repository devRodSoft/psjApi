<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DistribuidoraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="distribuidora-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]);?>

    <?php echo $form->field($model, 'id')?>

    <?php echo $form->field($model, 'nombre')?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary'])?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
