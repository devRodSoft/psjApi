<?php

use yii\web\View;
use yii\helpers\Html;
use common\models\Cine;
use common\models\Sala;
use common\models\Pelicula;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Funcion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="funcion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'cine_id')->dropDownList(array_column(Cine::Find()->All(), 'nombre', 'id'), ['prompt' => 'selecciona un cine']) ?>

    <?php // Usage with ActiveForm and model
    echo $form->field($model, 'pelicula_id')->widget(
        Select2::classname(),
        [
            'data' => array_column(Pelicula::Find()->orderBy('id DESC')->All(), 'nombre', 'id'),
            'options' => ['placeholder' => 'Selecciona una pelicula ...'],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ]
    ); ?>

    <?php // Usage with ActiveForm and model
    echo $form->field($model, 'sala_id')->widget(
        Select2::classname(),
        [
            'data' => array_column(
                Sala::Find()->orderBy('nombre')->All(),
                'nombre',
                'id'
            ),
            'options' => ['placeholder' => 'Selecciona una sala ...'],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ]
    ); ?>

    <?php echo $form->field($model, 'hora')->widget(
        TimePicker::classname(),
        [
            'pluginOptions' => [
                'showMeridian' => false,
                'minuteStep' => 10,
            ]
        ]
    ); ?>

    <?php
    echo $form->field($model, 'fecha')->widget(
        DatePicker::className(),
        [
            'language' => 'es',
            'size' => 'sm',
            'removeButton' => false,
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startDate' => date("Y-m-d"),
            ],
        ]
    );
    ?>

    <?php echo $form->field($model, 'publicar')->checkbox() ?>


    <?php /* echo $form->field($model, 'precio[]')->widget(MultiSelect::className(), [
'data' => ['super', 'natural'], 'options' => ['multiple' => "multiple"],
]) */ ?>


    <div class="alert alert-warning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">precaucion:</span>
        Los precios no deben repetirse.
    </div>

    <table id="myTable" class="table table-striped table-bordered detail-view order-list">
        <thead>
            <tr>
                <td class="col-md-9">Precio</td>
                <td class="col-md-2">Usar especial</td>
                <td class="col-md-1"></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model->horarioPrecios as $idx => $horarioPrecio) : ?>
                <tr>
                    <td>
                        <?php echo Html::dropDownList('horarioPrecio[' . $idx . '][precio][id]', $horarioPrecio->precio_id, $preciosList, ['prompt' => 'selecciona una pelicula', 'class' => 'form-control']) ?>
                    </td>
                    <td class="input-group-addon"><?php echo Html::checkbox('horarioPrecio[' . $idx . '][precio][usar_especial]', !!$horarioPrecio->usar_especial, ['label' => '']) ?></td>
                    <td><input type="button" class="ibtnDel btn btn-md btn-danger" value="Borrar"></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text - align:left;">
                    <input type="button" class="btn btn-lg btn-block btn-primary" id="addrow" value="Agregar Precio" />
                </td>
            </tr>
            <tr>
            </tr>
        </tfoot>
    </table>


    <div class="form - group">
        <?php echo Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs(
    "$(document).ready(function () {
    var counter = $('table.order-list tbody tr').length;
    $('#addrow').on('click', function () {
        var limit   = " . count($preciosList) . " || 0;
        if (limit === counter) {
            return;
        }
        var newRow = $('<tr>');
        var cols   = '';

        cols += '<td>" . str_replace(["\n", 'counter'], ['', "'+counter+'"], Html::dropDownList('horarioPrecio[counter][precio][id]', "", $preciosList, ['prompt' => 'selecciona un precio', 'class' => 'form-control'])) . "</td>';
        cols += '<td class=\"input-group-addon\"><input type=\"checkbox\" name=\"horarioPrecio['+counter+'][precio][usar_especial]\"/></td>';

        cols += '<td><input type=\"button\" class=\"ibtnDel btn btn-md btn-danger\"  value=\"Borrar\"></td>';

        newRow.append(cols);
        $('table.order-list tbody').append(newRow);
        counter++
    });

    $('table.order-list tbody').on('click', '.ibtnDel', function (event) {
        $(this).closest('tr').remove();
        counter -= 1;
    });
});",
    \yii\web\View::POS_READY,
    'my-button-handler'
);
?>
