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
            [['tipo_pago', 'qr_phat', 'hash'], 'string', 'max' => 255],
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
            'qr_phat' => 'Ruta de imagen',
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
        return $this->hasMany(salaAsientos::className(), ['id' => 'sala_asiento_id'])
            ->via('boletoAsientos');
    }

    public function getSalaAsientosIDs()
    {
        return array_column($this->boletoAsientos, 'sala_asiento_id');
    }

    private function setHash()
    {
        $this->hash = md5(
            $this->horario_funcion_id .
            join("", $this->salaAsientosIDs) .
            (new \DateTime())->getTimestamp()
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLabel()
    {
        return sprintf("%s _ %s", $this->horarioFuncion->fecha, $this->horarioFuncion->getFHora());
    }

    public function setQR()
    {
        $storagePath = Yii::getAlias('@QRs/' . $this->face_user_id);
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0777, true);
        }

        $this->setHash();

        $this->qr_phat = '/' . $this->id_pago . (new \DateTime())->getTimestamp() . '.png';

        Yii::$app->get('qr')
            ->setText($this->hash)
            ->setLabel($this->hash)
            ->setSize(500)
            ->setMargin(10)
            ->writeFile($storagePath . $this->qr_phat);
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
