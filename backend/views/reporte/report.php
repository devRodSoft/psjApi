<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PromocionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocion-index">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a('imprimir', ['imprimirGeneral'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget($widgetData); ?>
</div>
