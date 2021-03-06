<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Distribuidora */

$this->title                   = 'Editar Distribuidora: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Distribuidoras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="distribuidora-update">

    <h1><?php echo Html::encode($this->title)?></h1>

    <?php echo $this->render('_form', [
    'model' => $model,
])?>

</div>
