<?php

namespace common\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "boleto".
 *
 * @property int $id
 * @property int $face_user_id
 * @property int $horario_funcion_id
 * @property int $reclamado
 * @property int $reimpreso
 * @property string $created_at
 * @property string $updated_at
 * @property int $id_pago
 * @property string $tipo_pago
 * @property string $qr_phat ruta al qr de la operacion
 * @property string $hash hash de la operacion
 * @property int $user_id
 *
 * @property FaceUser $faceUser
 * @property HorarioFuncion $horarioFuncion
 * @property Pago $pago
 * @property User $user
 * @property BoletoAsiento[] $boletoAsientos
 * @property BoletoPrecio[] $boletoPrecios
 */
class Reporte extends \yii\db\ActiveRecord
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
            [['face_user_id', 'horario_funcion_id', 'reclamado', 'reimpreso', 'id_pago', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['tipo_pago', 'qr_phat', 'hash'], 'string', 'max' => 255],
            [['face_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => FaceUser::className(), 'targetAttribute' => ['face_user_id' => 'id']],
            [['horario_funcion_id'], 'exist', 'skipOnError' => true, 'targetClass' => HorarioFuncion::className(), 'targetAttribute' => ['horario_funcion_id' => 'id']],
            [['id_pago'], 'exist', 'skipOnError' => true, 'targetClass' => Pago::className(), 'targetAttribute' => ['id_pago' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'reimpreso' => 'Reimpreso',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'id_pago' => 'Id Pago',
            'tipo_pago' => 'Tipo Pago',
            'qr_phat' => 'Qr Phat',
            'hash' => 'Hash',
            'user_id' => 'User ID',
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
    public function getTotal()
    {

        $query = new Query;

        $query->select('SUM(bp.precio)')
            ->from(['bp' => BoletoPrecio::tableName()])
            ->where(['bp.boleto_id' => $this->id])
            ->groupBy('bp.boleto_id');
        return $query->scalar();
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
    public function getBoletoPrecios()
    {
        return $this->hasMany(BoletoPrecio::className(), ['boleto_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ReportesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReportesQuery(get_called_class());
    }
}
