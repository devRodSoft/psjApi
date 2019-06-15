<?php

namespace api\models;

/**
 * This is the model class for table "asiento".
 *
 * @property int $id
 * @property string $fila
 * @property int $numero
 * @property int $tipo
 * @property string $arreglo
 *
 * @property SalaAsientos[] $salaAsientos
 */
class SalaAsientoRest extends \common\models\SalaAsientos
{
    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'id',
            'fila',
            'tipo',
            'numero',
            'nombre',
        ];
    }
}
