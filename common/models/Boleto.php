<?php

namespace common\models;

use common\models\BoletoQuery;
use common\models\FaceUser;
use common\models\HorarioFuncion;
use common\models\Pelicula;
use common\models\SalaAsientos;
use common\models\User;
use Yii;
use yii\db\Query;

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
 * @property string $qr_phat ruta al qr de la operacion
 * @property string $hash hash de la operacion
 * @property int $user_id
 *
 * @property FaceUser $faceUser
 * @property HorarioFuncion $horarioFuncion
 * @property Pago $pago
 * @property User $user
 * @property BoletoAsiento[] $boletoAsientos
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
            [['face_user_id', 'horario_funcion_id', 'reclamado', 'id_pago', 'user_id', 'reimpreso'], 'integer'],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'id_pago' => 'Id Pago',
            'tipo_pago' => 'Tipo Pago',
            'qr_phat' => 'Qr Phat',
            'hash' => 'Hash',
            'reimpreso' => 'Reimpreso',
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
    public function getPrecios()
    {
        return $this->hasMany(Precio::className(), ['id' => 'precio_id'])->via('boletoAsientos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelicula()
    {
        return $this->hasOne(Pelicula::className(), ['id' => 'pelicula_id'])->via('horarioFuncion');
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
        return $this->hasMany(SalaAsientos::className(), ['id' => 'sala_asiento_id'])
            ->via('boletoAsientos');
    }

    public function getSalaAsientosIDs()
    {
        return array_column($this->boletoAsientos, 'sala_asiento_id');
    }

    private function setHash()
    {
        if (!$this->save()) {
            throw new \yii\web\HttpException(400, 'Hubo un error al procesar tu Pago');
        }

        $this->hash = strtoupper(
            substr($this->faceUser->username, 0, 1) .
                '-' .
                substr($this->faceUser->first_name, 0, 1) .
                substr($this->faceUser->last_name, 0, 1) .
                $this->id
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
            ->setSize(500)
            ->setMargin(10)
            ->writeFile($storagePath . $this->qr_phat);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTotal()
    {

        $query = new Query;

        $query->select('SUM(ba.precio)')
            ->from(['ba' => BoletoAsiento::tableName()])
            ->where(['ba.boleto_id' => $this->id])
            ->groupBy('ba.boleto_id');
        return $query->scalar();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreciosCount()
    {
        $query = new Query;

        $query->select('p.id, p.nombre, p.codigo, ba.precio')
            ->from(['ba' => BoletoAsiento::tableName()])
            ->innerJoin(['p' => Precio::tableName()], 'ba.precio_id = p.id')
            ->where(['ba.boleto_id' => $this->id]);
        // ->groupBy('p.id, p.nombre, p.codigo');
        $precios = $query->all();

        return $precios;
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
