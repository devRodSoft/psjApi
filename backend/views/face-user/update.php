<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FaceUser */

$this->title = 'Update Face User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Face Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="face-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
