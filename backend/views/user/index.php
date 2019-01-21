<?php

use common\models\Role;
use common\models\User;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Empleados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Crear Empleado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'username',
        'email:email',
        // 'role.nombre',
        'role_id' => [
            'label' => 'Role',
            'value' => function ($model) {
                return $model->role->nombre;
            },
        ],
        // 'status',
        'status' => [
            'label' => 'stat',
            'value' => function ($model) {
                return [User::STATUS_DELETED => 'Eliminado', User::STATUS_ACTIVE => 'Activo'][$model->status];
            },
        ],
        //'created_at',
        //'updated_at',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
</div>
