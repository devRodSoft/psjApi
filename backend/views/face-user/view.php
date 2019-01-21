<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FaceUser */

$this->title                   = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Face Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="face-user-view">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php // echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
        <?php /* echo Html::a('Delete', ['delete', 'id' => $model->id], [
'class' => 'btn btn-danger',
'data' => [
'confirm' => 'Are you sure you want to delete this item?',
'method' => 'post',
],
])*/?>
    </p>

    <?php echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        // 'username',
        'first_name',
        'last_name',
        'email:email',
        // 'cumpleaños',
        // 'status:boolean',
        'created_at',
        'updated_at',
    ],
]) ?>

</div>
