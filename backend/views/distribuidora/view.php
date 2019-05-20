<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Distribuidora */

$this->title                   = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Distribuidoras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="distribuidora-view">

    <h1><?php echo Html::encode($this->title)?></h1>

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
    ],
])?>
    </p>

    <?php echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'nombre',
    ],
])?>

</div>
