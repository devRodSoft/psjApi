<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "boleto".
 *
 * @property int $id
 * @property int $face_user_id
 * @property int $horario_funcion_id
 * @property int $sala_asientos_id
 * @property int $reclamado
 * @property string $created_at
 * @property string $updated_at
 */
class Boleto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'boleto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['face_user_id', 'horario_funcion_id', 'sala_asientos_id'], 'required'],
            [['face_user_id', 'horario_funcion_id', 'sala_asientos_id', 'reclamado'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'face_user_id' => 'Face User ID',
            'horario_funcion_id' => 'Horario Funcion ID',
            'sala_asientos_id' => 'Sala Asientos ID',
            'reclamado' => 'Reclamado',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BoletoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BoletoQuery(get_called_class());
    }
}
