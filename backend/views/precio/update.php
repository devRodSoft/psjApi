<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Precio */

$this->title                   = 'Actualizar Precio: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Precios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="precio-update">

    <h1><?php echo Html::encode($this->title)?></h1>

    <?php echo $this->render('_form', [
    'model' => $model,
])?>

</div>
