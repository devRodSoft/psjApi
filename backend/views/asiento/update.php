<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Asiento */

$this->title = 'Update Asiento: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Asientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asiento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
