<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Cine */

$this->title = 'Create Cine';
$this->params['breadcrumbs'][] = ['label' => 'Cines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cine-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
