<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
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
        <?php echo $form->field($filterModel, 'fecha')->widget(
            DatePicker::className(),
            [
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]
        ); ?>

        <?php echo $form->field($filterModel, 'username')->widget(
            Select2::classname(),
            [
                'data' => $usuarios,
                'options' => ['placeholder' => 'Selecciona un vendedor ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]
        ); ?>

    </p>


    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::resetButton('Reset', ['class' => 'btn btn-default'])
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
