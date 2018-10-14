<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Funcion */

$this->title = 'Create Funcion';
$this->params['breadcrumbs'][] = ['label' => 'Funcions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funcion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
