<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div>
    <?php
$form = ActiveForm::begin(
    [
        'action' => [$url],
        'method' => 'get',
    ]
);
?>

    <p>
        <?php echo $form->field($filterModel, 'boleto_creado')->widget(
    DatePicker::className(),
    [
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        ],
    ]
); ?>

    </p>


    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::resetButton('Reset', ['class' => 'btn btn-default'])
?>
    </div>

    <?php ActiveForm::end();?>

</div>
