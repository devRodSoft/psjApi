<?php

namespace api\models;

use Yii;
use \common\models\SalaAsientos;
use \common\models\Asiento;

/**
 * This is the model class for table "sala".
 *
 * @property int $id
 * @property int $cine_id
 * @property string $nombre
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Funcion[] $funcions
 * @property Cine $cine
 * @property SalaAsientos[] $salaAsientos
 */
class SalaRest extends \common\models\Sala
{

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'id',
            'cine_id',
            'nombre',
            'asientos',
        ];
    }
}
