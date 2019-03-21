<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "boleto".
 *
 * @property int $id
 * @property int $face_user_id
 * @property int $horario_funcion_id
 * @property int $reclamado
 * @property string $created_at
 * @property string $updated_at
 * @property int $id_pago
 * @property string $tipo_pago
 *
 * @property Pago $pago
 * @property FaceUser $faceUser
 * @property HorarioFuncion $horarioFuncion
 * @property BoletoAsiento[] $boletoAsientos
 * @property Pago[] $pagos
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
            [['face_user_id', 'horario_funcion_id'], 'required'],
            [['face_user_id', 'horario_funcion_id', 'reclamado', 'id_pago'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['tipo_pago'], 'string', 'max' => 255],
            [['id_pago'], 'exist', 'skipOnError' => true, 'targetClass' => Pago::className(), 'targetAttribute' => ['id_pago' => 'id']],
            [['face_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => FaceUser::className(), 'targetAttribute' => ['face_user_id' => 'id']],
            [['horario_funcion_id'], 'exist', 'skipOnError' => true, 'targetClass' => HorarioFuncion::className(), 'targetAttribute' => ['horario_funcion_id' => 'id']],
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
            'reclamado' => 'Reclamado',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'id_pago' => 'Id Pago',
            'tipo_pago' => 'Tipo Pago',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPago()
    {
        return $this->hasOne(Pago::className(), ['id' => 'id_pago']);
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
    public function getBoletoAsientos()
    {
        return $this->hasMany(BoletoAsiento::className(), ['boleto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pago::className(), ['boleto_id' => 'id']);
    }

    public function getSalaAsientos()
    {
        return $this->hasMany(Pago::className(), ['boleto_id' => 'id'])
            ->via('boletoAsientos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCode()
    {
        return md5(sprintf("%s-%s-%s-%s", $this->id, $this->horario_funcion_id, join("", array_column($this->boletoAsientos, 'id')), $this->faceUser->username));
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLabel()
    {
        return sprintf("%s _ %s", $this->horarioFuncion->fecha, $this->horarioFuncion->getFHora());
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
