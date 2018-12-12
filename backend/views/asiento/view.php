<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Asiento */

$this->title                   = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Asientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asiento-view">

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
        [
            'label' => 'nombre',
            'value' => function ($m) {
                return $m->fila . '-' . $m->numero;
            }],
        [
            'label' => 'tipo',
            'value' => function ($m) {
                return [0 => 'Pasillo', 1 => 'Asiento', 2 => 'Silla de ruedas'][$m->tipo];
            }],
        'arreglo:ntext',
    ],
]) ?>

</div>
