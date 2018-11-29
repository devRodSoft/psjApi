<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cine */

$this->title = 'Actualizar Cine: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="cine-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
