<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Boleto */

$this->title                   = 'Actualizar Boleto: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Boletos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="boleto-update">

    <h1><?php echo Html::encode($this->title)?></h1>

    <?php echo $this->render('_form', [
    'model' => $model,
    'asientos' => $asientos,
])?>

</div>
