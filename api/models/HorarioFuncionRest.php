<?php

namespace api\models;

use common\models\Pelicula;
use common\models\Sala;

/**
 * This is the model class for table "horario_funcion".
 *
 * @property int $id
 * @property int $pelicula_id
 * @property int $sala_id
 * @property string $hora
 * @property string $fecha
 *
 * @property Boleto[] $boletos
 * @property Funcion $funcion
 * @property Sala $sala
 */
class HorarioFuncionRest extends \common\models\HorarioFuncion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pelicula_id', 'sala_id', 'hora', 'fecha'], 'required'],
            [['pelicula_id', 'sala_id'], 'integer'],
            [['hora', 'fecha'], 'safe'],
            [['pelicula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pelicula::className(), 'targetAttribute' => ['pelicula_id' => 'id']],
            [['sala_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sala::className(), 'targetAttribute' => ['sala_id' => 'id']],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'id',
            'cine_id',
            'fecha',
            'sala',
            'precios' => function ($m) {
                return $m->horarioPrecios;
            },
            'publicar',
            'status' => function ($m) {
                $date1 = new \DateTime("now");
                $date2 = \DateTime::createFromFormat('Y-m-dH:i:s', $this->fecha . $this->hora);
                return $date1 < $date2;
            },
            'hora' => function ($m) {
                return $m->getFHora();
            },
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarioPrecios()
    {
        return $this->hasMany(HorarioPrecioRest::className(), ['horario_id' => 'id']);
    }
}
