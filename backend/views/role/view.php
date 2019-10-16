<?php

use yii\helpers\Html;
use common\models\Permiso;
use yii\widgets\DetailView;
use softark\duallistbox\DualListbox;

/* @var $this yii\web\View */
/* @var $model common\models\Role */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="role-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre:ntext',
            'descripcion',
        ],
    ]) ?>

    <table class="table table-striped table-bordered detail-view">
        <thead>
            <tr>
                <th>Permisos asignados</th>
            </tr>
        </thead>
        <?php foreach ($model->permisos as $permiso) : ?>

            <tr>
                <td>
                    <?= $permiso->nombre ?>
                </td>
            </tr>

        <?php endforeach; ?>
    </table>


</div>
