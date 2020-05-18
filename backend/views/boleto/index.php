<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use common\models\User;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BoletoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Boletos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boleto-index">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
        $listUsers = User::find()->all();
        $user = ArrayHelper::map($listUsers,'id','username');
    ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Código',
                'attribute' => 'id'
            ],
            [
                'label' => 'Fecha Venta',
                'attribute' => 'pago.create_time'
            ],
            [
                'label' => 'Vendedor',
                'attribute' => 'user_id',
                'value' => 'user.username',
                'filter' => $user,
            ],                    
            [
                'label' => 'Nombre',
                'attribute' => 'faceUser.nombre',
                'value' => function ($model) {
                    return $model->user->username != 'App' ? '' : $model->faceUser->nombre;
                },
                'filter' => true
            ],
            [
                'label' => 'Pelicula',
                'attribute' => 'pelicula.nombre'
            ],
            'horarioFuncion.fecha',
            [
                'label' => 'Función',
                'attribute' => 'horarioFuncion.hora'
            ],
            [
                'label' => 'Sala',
                'attribute' => 'horarioFuncion.sala.nombre'
            ],

            'reclamado:boolean',
            //'hash',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
