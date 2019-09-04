<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title                   = $title;
?>
<div>

    <h1>Reporte: <?php echo Html::encode($this->title) ?></h1>

    <?php echo GridView::widget($widgetData); ?>
</div>
