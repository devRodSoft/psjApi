<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PromocionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = $title;
$this->params['breadcrumbs'][] = ['label' => 'Reportes', 'url' => ['/reporte']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocion-index">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::button('imprimir', ['class' => 'btn btn-success', 'onclick' => "var iframe = document.createElement('iframe');
iframe.style.display = 'none';
iframe.src = (window.location.href.indexOf('?') > 0)? window.location.href + '&print=true' : window.location.href + '?print=true';
iframe.name = 'printf';
iframe.id = 'printf';
document.body.appendChild(iframe);
window.frames['printf'].focus();
window.frames['printf'].print();
window.frames['printf'].document.close();"]) ?>
    </p>

    <?php echo GridView::widget($widgetData); ?>
</div>
