<?php

namespace api\models;

use common\models\HorarioFuncion;
use common\models\Sala;
use common\models\SalaAsientosQuery;
use Yii;

/**
 * This is the model class for table "sala_asientos".
 *
 * @property int $id
 * @property int $sala_id
 *
 * @property BoletoAsiento[] $boletoAsientos
 * @property Sala $sala
 */
class SalaAsientosRest extends \yii\db\ActiveRecord
{
    public $ocupadoAsiento     = true;
    public $apartadoAsiento    = null;
    public $id_relacion_boleto = null;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sala_asientos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sala_id', 'fila', 'numero', 'tipo'], 'required'],
            [['numero', 'tipo', 'sala_id'], 'integer'],
            [['fila'], 'string', 'max' => 1],
            [['sala_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sala::className(), 'targetAttribute' => ['sala_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sala_id' => 'Sala ID',
            'fila' => 'Fila',
            'numero' => 'Numero',
            'nombre' => 'asiento',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'id',
            'fila',
            'sala_id',
            'tipo',
            'numero',
            'nombre',
            'orden_fila',
            'orden_columna',
            'id_relacion_boleto',
            'ocupado' => function ($m) {
                return $m->ocupadoAsiento == null ? null : ($m->ocupadoAsiento == '0' ? false : true);
            },
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombre()
    {
        return $this->fila . $this->numero;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoletoAsientos()
    {
        return $this->hasMany(BoletoAsiento::className(), ['sala_asiento_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSala()
    {
        return $this->hasOne(Sala::className(), ['id' => 'sala_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarioFuncion()
    {
        return $this->hasOne(HorarioFuncion::className(), ['id' => 'sala_id'])->via('sala');
    }

    /**
     * {@inheritdoc}
     * @return SalaAsientosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SalaAsientosQuery(get_called_class());
    }
}
