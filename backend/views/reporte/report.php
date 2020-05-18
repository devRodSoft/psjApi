<?php

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PromocionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = $title;
$this->params['breadcrumbs'][] = ['label' => 'Reportes', 'url' => ['/reporte']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocion-index">
    <?php echo $this->render($searchTemplate, $searchTemplateData);
    ?>
    <?php echo GridView::widget($widgetData); ?>
</div>
