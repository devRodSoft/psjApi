<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "boleto_precio".
 *
 * @property int $id
 * @property int $boleto_id
 * @property int $precio_id
 * @property string $precio
 *
 * @property Boleto $boleto
 * @property Precio $precio0
 */
class BoletoPrecio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'boleto_precio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['boleto_id', 'precio_id', 'precio'], 'required'],
            [['boleto_id', 'precio_id'], 'integer'],
            [['precio'], 'number'],
            [['boleto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Boleto::className(), 'targetAttribute' => ['boleto_id' => 'id']],
            [['precio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Precio::className(), 'targetAttribute' => ['precio_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'boleto_id' => 'Boleto ID',
            'precio_id' => 'Precio ID',
            'precio' => 'Precio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoleto()
    {
        return $this->hasOne(Boleto::className(), ['id' => 'boleto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrecioRel()
    {
        return $this->hasOne(Precio::className(), ['id' => 'precio_id']);
    }

    /**
     * {@inheritdoc}
     * @return BoletoPrecioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BoletoPrecioQuery(get_called_class());
    }
}
