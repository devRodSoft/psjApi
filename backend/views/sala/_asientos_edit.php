<?php

/* @var $this yii\web\View */
/* @var $model common\models\Sala */
/* @var $form yii\widgets\ActiveForm */
?>

<table class="table table-striped table-bordered" style="text-align:center">
    <tbody>
    <?php foreach ($model->asientosAsMtx as $row): ?>
        <tr>
        <?php foreach ($row['asientos'] as $asiento): ?>
            <?php $colspan = count($row['asientos'])?>
            <td><?php echo ($asiento->tipo != 0) ? $asiento->nombre : '' ?></td>
        <?php endforeach?>
        </tr>
    <?php endforeach?>
    </tbody>
    <tfoot>
        <tr>
            <th style="text-align:center" colspan="<?php echo $colspan ?>">Pantalla</th>
        </tr>
    </tfoot>
</table>
