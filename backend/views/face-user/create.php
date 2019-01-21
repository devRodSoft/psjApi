<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FaceUser */

$this->title                   = 'Create Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Face Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="face-user-create">

    <h1><?php echo Html::encode($this->title)?></h1>

    <?php echo $this->render('_form', [
    'model' => $model,
])?>

</div>
