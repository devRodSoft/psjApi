<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Funcion */

$this->title                   = 'Crear Funcion';
$this->params['breadcrumbs'][] = ['label' => 'Funcions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funcion-create">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
    'model' => $model,
    'preciosList' => $preciosList,
]) ?>

</div>
