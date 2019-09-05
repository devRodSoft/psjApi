<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Promocion */

$this->title = 'Crear Promocion';
$this->params['breadcrumbs'][] = ['label' => 'Promociones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
