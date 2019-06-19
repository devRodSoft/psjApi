<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Estreno */

$this->title = 'Create Estreno';
$this->params['breadcrumbs'][] = ['label' => 'Estrenos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estreno-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
