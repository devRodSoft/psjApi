<?php

use common\models\Permiso;
use softark\duallistbox\DualListbox;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Role */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="role-form">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'nombre')->label('Nombre')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'descripcion')->textInput(['maxlength' => true])?>
    <?php
// echo $form->field($model, $attribute)->listBox($items, $options);
echo $form->field($model, 'permisos')->label('')->widget(
    DualListbox::className(),
    [
        'items' => array_column(Permiso::find()->all(), 'nombre', 'id'),
        'options' => [
            'multiple' => true,
            'size' => 20,
        ],
        'clientOptions' => [
            'moveOnSelect' => false,
            'selectedListLabel' => 'Permisos asignados',
            'nonSelectedListLabel' => 'Permisos disponibles',
            'filterPlaceHolder' => 'Buscar',
            'infoText' => 'Mostrando {0}',
            'infoTextEmpty' => 'Lista vacia',
            'infoTextFiltered' => '<span class="label label-warning">Filtrado</span> {0} de {1}',
            'filterTextClear' => 'Mostrar todo',
            'moveSelectedLabel' => 'Mover seleccionado',
            'moveAllLabel' => 'Mover todo',
            'removeSelectedLabel' => 'Remover seleccionado',
            'removeAllLabel' => 'Remover todo',
        ],
    ]
);
?>

    <div class="form-group">
        <?=Html::submitButton('Guardar', ['class' => 'btn btn-success'])?>
    </div>


    <?php ActiveForm::end();?>

</div>
