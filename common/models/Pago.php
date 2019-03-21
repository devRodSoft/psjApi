<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pago".
 *
 * @property int $id
 * @property int $boleto_id
 * @property int $face_user_id
 * @property string $create_time
 * @property string $id_pago_paypal
 * @property string $intent
 * @property string $state
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Boleto[] $boletos
 * @property FaceUser $faceUser
 * @property Boleto $boleto
 */
class Pago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['boleto_id', 'face_user_id', 'create_time', 'id_pago_paypal', 'intent', 'state'], 'required'],
            [['boleto_id', 'face_user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['create_time'], 'string', 'max' => 100],
            [['id_pago_paypal'], 'string', 'max' => 255],
            [['intent', 'state'], 'string', 'max' => 50],
            [['face_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => FaceUser::className(), 'targetAttribute' => ['face_user_id' => 'id']],
            [['boleto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Boleto::className(), 'targetAttribute' => ['boleto_id' => 'id']],
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
            'face_user_id' => 'Face User ID',
            'create_time' => 'Create Time',
            'id_pago_paypal' => 'Id Pago Paypal',
            'intent' => 'Intent',
            'state' => 'State',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoletos()
    {
        return $this->hasMany(Boleto::className(), ['id_pago' => 'id']);
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
    public function getBoleto()
    {
        return $this->hasOne(Boleto::className(), ['id' => 'boleto_id']);
    }

    /**
     * {@inheritdoc}
     * @return PagoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PagoQuery(get_called_class());
    }
}
