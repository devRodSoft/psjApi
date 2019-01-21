<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Sala */

$this->title                   = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Salas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sala-view">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Borrar', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => 'Estas seguro que quieres eliminar este elemento?',
        'method' => 'post',
    ],
]) ?>
    </p>

    <?php echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'cine.nombre',
        'nombre:ntext',
        'created_at',
        'updated_at',
    ],
]) ?>

<table class="table table-striped table-bordered" style="text-align:center">
    <tbody>
    <?php foreach ($model->asientosAsMtx as $index => $asientos): ?>
        <tr>
        <?php foreach ($asientos as $asiento): ?>
            <td><?php echo $asiento->nombre ?></td>
        <?php endforeach?>
        </tr>
    <?php endforeach?>
    </tbody>
    <tfoot>
        <tr>
            <th style="text-align:center" colspan="<?php echo count($model->asientosAsMtx[$index]) ?>">Pantalla</th>
        </tr>
    </tfoot>
</table>

</div>
