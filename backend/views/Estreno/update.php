<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Estreno */

$this->title = 'Actualizar Estreno: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Estrenos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="estreno-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
