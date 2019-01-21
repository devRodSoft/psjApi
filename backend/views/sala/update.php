<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Sala */

$this->title                   = 'Actualizar: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Salas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="sala-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
    'model' => $model,
]) ?>

</div>
