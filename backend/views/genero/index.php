<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GeneroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Generos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genero-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <p>
        <?= Html::a('Crear Genero', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nombre',

            [
                'class' => 'yii\grid\ActionColumn',
                'visible' => Yii::$app->user->isGuest ? false : true,
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>
</div>
