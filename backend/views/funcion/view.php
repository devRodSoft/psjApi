<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Funcion */

$this->title                   = $model->pelicula->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Funcions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="funcion-view">

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
        'pelicula.nombre',
        'precio:currency',
        'created_at',
        'updated_at',
    ],
]) ?>

<table id="myTable" class=" table order-list">
        <thead>
            <tr>
                <td>Fecha</td>
                <td>Hora</td>
                <td>Sala</td>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($model->horarios as $key => $horario): ?>
            <tr>
                <td>
                    <?php echo $horario->fecha ?>
                </td>
                <td>
                    <?php echo $horario->hora ?>
                </td>
                <td>
                    <?php echo $horario->sala->nombre ?>
                </td>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>

</div>
