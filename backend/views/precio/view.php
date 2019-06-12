<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Precio */

$this->title                   = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Precios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="precio-view">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /* echo Html::a('Delete', ['delete', 'id' => $model->id], [
'class' => 'btn btn-danger',
'data' => [
'confirm' => 'estas seguro que quieres el?',
'method' => 'post',
],
]) */?>
    </p>

    <?php echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'nombre',
        'default',
        'especial',
    ],
]) ?>

</div>
