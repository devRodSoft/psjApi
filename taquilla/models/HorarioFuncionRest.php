<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "horario_funcion".
 *
 * @property int $id
 * @property int $funcion_id
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
    public static function tableName()
    {
        return 'horario_funcion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['funcion_id', 'sala_id', 'hora', 'fecha'], 'required'],
            [['funcion_id', 'sala_id'], 'integer'],
            [['hora', 'fecha'], 'safe'],
            [['funcion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Funcion::className(), 'targetAttribute' => ['funcion_id' => 'id']],
            [['sala_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sala::className(), 'targetAttribute' => ['sala_id' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoletos()
    {
        return $this->hasMany(\common\models\Boleto::className(), ['horario_funcion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFuncion()
    {
        return $this->hasOne(\common\models\Funcion::className(), ['id' => 'funcion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSala()
    {
        return $this->hasOne(\common\models\Sala::className(), ['id' => 'sala_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'id',
            'funcion_id',
            'sala_id',
            'sala',
            'status' => function ($m) {
                $date1 = new \DateTime("now");
                $date2 = \DateTime::createFromFormat('Y-m-dH:i:s', $this->fecha . $this->hora);
                return $date1 < $date2;
            },
            'hora' => function ($m) {
                return $m->getFHora();
            },
            'fecha',
        ];
    }
}
