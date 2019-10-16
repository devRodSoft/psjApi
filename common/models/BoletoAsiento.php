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

    foreach ($salaAsientos as $idx => $salaAsiento) {
        $boletoAsiento                  = new BoletoAsiento();
        $boletoAsiento->sala_asiento_id = $salaAsiento->id;
        $boletoAsiento->boleto_id       = $boleto->id;
        $boletoAsiento->precio_id = $precios[$idx]->precio->id;
        $boletoAsiento->precio    = ($precios[$idx]->usar_especial == 1) ? $precios[$idx]->precio->especial : $precios[$idx]->precio->default;
        if (!$boletoAsiento->save()) {
            throw new HttpException(400, 'Hubo un error al apartar tus asientos');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sala_asiento_id', 'boleto_id', 'precio_id', 'precio'], 'required'],
            [['sala_asiento_id', 'boleto_id','precio_id'], 'integer'],
            [['precio'], 'number'],
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
    public function getSalaAsientos()
    {
        return $this->hasOne(SalaAsientos::className(), ['id' => 'sala_asiento_id']);
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
