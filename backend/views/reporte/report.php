<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PromocionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = $title;
$this->params['breadcrumbs'][] = ['label' => 'Reportes', 'url' => ['/reporte']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocion-index">
    <?php echo $this->render(
        '_bpelicula.php',
        [
            'filterModel' => $filterModel,
            'url' => $url
            // 'usuarios' => $usuarios,
        ]
    )  ?>
    <?php echo GridView::widget($widgetData); ?>
</div>
