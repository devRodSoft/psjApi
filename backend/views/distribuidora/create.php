<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Distribuidora */

$this->title                   = 'Crear Distribuidora';
$this->params['breadcrumbs'][] = ['label' => 'Distribuidoras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distribuidora-create">

    <h1><?php echo Html::encode($this->title)?></h1>

    <?php echo $this->render('_form', [
    'model' => $model,
])?>

</div>
