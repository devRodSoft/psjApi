<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "boleto_asiento".
 *
 * @property int $sala_asiento_id
 * @property int $boleto_id
 *
 * @property SalaAsientos $salaAsiento
 * @property Boleto $boleto
 */
class BoletoAsiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'boleto_asiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sala_asiento_id', 'boleto_id'], 'required'],
            [['sala_asiento_id', 'boleto_id'], 'integer'],
            [['sala_asiento_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalaAsientos::className(), 'targetAttribute' => ['sala_asiento_id' => 'id']],
            [['boleto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Boleto::className(), 'targetAttribute' => ['boleto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sala_asiento_id' => 'Sala Asiento ID',
            'boleto_id' => 'Boleto ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalaAsiento()
    {
        return $this->hasOne(SalaAsientos::className(), ['id' => 'sala_asiento_id']);
    }

    public function getAsiento()
    {
        return $this->hasOne(Asiento::className(), ['id' => 'asiento_id'])->via('salaAsiento');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoleto()
    {
        return $this->hasOne(Boleto::className(), ['id' => 'boleto_id']);
    }

    /**
     * {@inheritdoc}
     * @return BoletoAsientoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BoletoAsientoQuery(get_called_class());
    }

    public static function primaryKey()
    {

        return ['boleto_id'];

    }
}
