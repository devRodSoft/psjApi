<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Precio */

$this->title                   = 'Crear Precio';
$this->params['breadcrumbs'][] = ['label' => 'Precios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="precio-create">

    <h1><?php echo Html::encode($this->title)?></h1>

    <?php echo $this->render('_form', [
    'model' => $model,
])?>

</div>
