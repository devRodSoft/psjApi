<?php

use kartik\grid\GridView;
use yii\helpers\Html;

$this->title                   = $title;
?>
<div>

    <h1>Reporte: <?php echo Html::encode($this->title) ?></h1>
    <?php if (!empty($widgetData['filterModel']->fechaInicio)) : ?>
        <h4>Desde: <?php echo Html::encode($widgetData['filterModel']->fechaInicio); ?></h4>
        <h4>hasta: <?php echo Html::encode($widgetData['filterModel']->fechaFin); ?></h4>
    <?php endif; ?>
    <?php echo GridView::widget($widgetData); ?>
</div>
