<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FaceUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Face Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="face-user-index">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <!-- <?php echo Html::a('Create Face User', ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>

    <?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'username',
        'first_name',
        'last_name',
        'email:email',
        //'cumpleaños',
        //'status',
        //'created_at',
        //'updated_at',

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
        ],
    ],
]); ?>
</div>
