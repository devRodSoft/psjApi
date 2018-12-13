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
 *
 * @property FaceUser $faceUser
 * @property HorarioFuncion $horarioFuncion
 * @property SalaAsientos $salaAsientos
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
            [['face_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => FaceUser::className(), 'targetAttribute' => ['face_user_id' => 'id']],
            [['horario_funcion_id'], 'exist', 'skipOnError' => true, 'targetClass' => HorarioFuncion::className(), 'targetAttribute' => ['horario_funcion_id' => 'id']],
            [['sala_asientos_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalaAsientos::className(), 'targetAttribute' => ['sala_asientos_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'face_user_id' => 'FaceBook user',
            'horario_funcion_id' => 'Horario',
            'sala_asientos_id' => 'Asiento',
            'reclamado' => 'Usado',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaceUser()
    {
        return $this->hasOne(FaceUser::className(), ['id' => 'face_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarioFuncion()
    {
        return $this->hasOne(HorarioFuncion::className(), ['id' => 'horario_funcion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalaAsientos()
    {
        return $this->hasOne(SalaAsientos::className(), ['id' => 'sala_asientos_id']);
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
