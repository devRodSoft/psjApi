<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Funcion */

$this->title                   = $model->pelicula->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Funcion', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="funcion-view">

    <h1><?php echo Html::a(Html::encode($model->pelicula->nombre), ['funcion/calendar', 'id' => $model->pelicula_id]) ?></h1>

    <p>
        <?php echo Html::a('Crear Función', ['create'], ['class' => 'btn btn-success']) ?>
        <?php echo Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Estas seguro que quieres eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget(
        [
            'model' => $model,
            'attributes' => [
                'publicar:boolean',
                [
                    'label' => 'pelicula',
                    'value' => function ($m) {
                        return $m->pelicula->nombre;
                    }
                ],
                [
                    'label' => 'sala',
                    'value' => function ($m) {
                        return $m->sala->nombre;
                    }
                ],
                'fecha:date',
                'hora',
            ],
        ]
    ) ?>

    <h2>Precios</h2>
    <table id="myTable" class="table table-striped table-bordered detail-view">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Código</th>
                <th>Precio</th>
                <th>Usando especial</th>


            </tr>
        </thead>
        <tbody>
            <?php foreach ($model->horarioPrecios as $horarioPrecio) : ?>
                <tr>
                    <td><?php echo $horarioPrecio->precio->nombre ?></td>
                    <td><?php echo $horarioPrecio->precio->codigo ?></td>
                    <td><?php echo ($horarioPrecio->usar_especial) ? $horarioPrecio->precio->especial : $horarioPrecio->precio->default ?></td>
                    <td><?php echo ($horarioPrecio->usar_especial) ? 'si' : 'no' ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>


</div>
