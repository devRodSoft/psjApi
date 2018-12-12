<?php

namespace api\models;

use \common\models\Asiento;
use \common\models\SalaAsientos;

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
    public $horario = null;
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

    public function getAsientos()
    {
        if (empty($this->horario)) {
            return parent::getAsientos();
        } else {
            return Asiento::find()
                ->select(['a.*', 'ocupadoAsiento' => 'if(b.id is null, 0, 1)'])
                ->from(['hf' => 'horario_funcion'])
                ->join('inner join', ['sa' => 'sala_asientos'], 'hf.sala_id = sa.sala_id')
                ->join('inner join', ['a' => 'asiento'], 'a.id = sa.asiento_id')
                ->join('left join', ['b' => 'boleto'], 'a.id = b.sala_asientos_id')
                ->where(['hf.id' => $this->horario])
                ->ordered()
                ->all();
        }
    }
}
