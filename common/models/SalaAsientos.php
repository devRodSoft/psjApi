<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sala_asientos".
 *
 * @property int $id
 * @property int $sala_id
 * @property int $asiento_id
 *
 * @property BoletoAsiento[] $boletoAsientos
 * @property Asiento $asiento
 * @property Sala $sala
 */
class SalaAsientos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sala_asientos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sala_id', 'asiento_id'], 'required'],
            [['sala_id', 'asiento_id'], 'integer'],
            [['asiento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Asiento::className(), 'targetAttribute' => ['asiento_id' => 'id']],
            [['sala_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sala::className(), 'targetAttribute' => ['sala_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sala_id' => 'Sala ID',
            'asiento_id' => 'Asiento ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoletoAsientos()
    {
        return $this->hasMany(BoletoAsiento::className(), ['sala_asiento_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsiento()
    {
        return $this->hasOne(Asiento::className(), ['id' => 'asiento_id'])->ordered();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSala()
    {
        return $this->hasOne(Sala::className(), ['id' => 'sala_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarioFuncion()
    {
        return $this->hasOne(HorarioFuncion::className(), ['id' => 'sala_id'])->via('sala');
    }

    /**
     * {@inheritdoc}
     * @return SalaAsientosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SalaAsientosQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'id',
            'sala_id',
            'asiento_id',
            'asiento',
        ];
    }
}
