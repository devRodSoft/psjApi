<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "horario_precio".
 *
 * @property int $horario_id
 * @property int $precio_id
 * @property int $usar_especial
 *
 * @property HorarioFuncion $horario
 * @property Precio $precio
 */
class HorarioPrecio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'horario_precio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['horario_id', 'precio_id'], 'required'],
            [['horario_id', 'precio_id', 'usar_especial'], 'integer'],
            [['horario_id', 'precio_id'], 'unique', 'targetAttribute' => ['horario_id', 'precio_id']],
            [['horario_id'], 'exist', 'skipOnError' => true, 'targetClass' => HorarioFuncion::className(), 'targetAttribute' => ['horario_id' => 'id']],
            [['precio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Precio::className(), 'targetAttribute' => ['precio_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'horario_id' => 'Horario ID',
            'precio_id' => 'Precio ID',
            'usar_especial' => 'Usar Especial',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'precio',
            'usar_especial',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorario()
    {
        return $this->hasOne(HorarioFuncion::className(), ['id' => 'horario_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrecio()
    {
        return $this->hasOne(Precio::className(), ['id' => 'precio_id']);
    }

    /**
     * {@inheritdoc}
     * @return HorarioPrecioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HorarioPrecioQuery(get_called_class());
    }
}
