<?php

namespace common\models;

use common\models\SalaAsientos as SalaAsientos;
use Yii;

/**
 * This is the model class for table "apartado_asiento".
 *
 * @property string $id
 * @property int $sala_asiento_id
 * @property int $precio_id
 * @property string $precio
 * @property int $horario_funcion_id
 * @property string $apartado_id
 *
 * @property SalaAsientos $salaAsiento
 * @property Precio $precio0
 * @property Apartado $apartado
 */
class ApartadoAsiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apartado_asiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sala_asiento_id', 'precio_id', 'precio', 'horario_funcion_id', 'apartado_id'], 'required'],
            [['sala_asiento_id', 'precio_id', 'horario_funcion_id', 'apartado_id'], 'integer'],
            [['precio'], 'number'],
            [['horario_funcion_id', 'sala_asiento_id'], 'unique', 'targetAttribute' => ['horario_funcion_id', 'sala_asiento_id']],
            [['sala_asiento_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalaAsientos::className(), 'targetAttribute' => ['sala_asiento_id' => 'id']],
            [['precio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Precio::className(), 'targetAttribute' => ['precio_id' => 'id']],
            [['apartado_id'], 'exist', 'skipOnError' => true, 'targetClass' => Apartado::className(), 'targetAttribute' => ['apartado_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sala_asiento_id' => 'Sala Asiento ID',
            'precio_id' => 'Precio ID',
            'precio' => 'Precio',
            'horario_funcion_id' => 'Horario Funcion ID',
            'apartado_id' => 'Apartado ID',
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'id' => function ($m) {
                return $m->sala_asiento_id;
            },
            'precio_id',
            'precio',
            'fila' => function ($m) {
                return $m->salaAsiento->fila;
            },
            'sala_id' => function ($m) {
                return $m->salaAsiento->sala_id;
            },
            'tipo' => function ($m) {
                return $m->salaAsiento->tipo;
            },
            'numero' => function ($m) {
                return $m->salaAsiento->numero;
            },
            'nombre' => function ($m) {
                return $m->salaAsiento->nombre;
            },
            'orden_fila' => function ($m) {
                return $m->salaAsiento->orden_fila;
            },
            'orden_columna' => function ($m) {
                return $m->salaAsiento->orden_columna;
            },
        ];

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalaAsiento()
    {
        return $this->hasOne(SalaAsientos::className(), ['id' => 'sala_asiento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrecio0()
    {
        return $this->hasOne(Precio::className(), ['id' => 'precio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartado()
    {
        return $this->hasOne(Apartado::className(), ['id' => 'apartado_id']);
    }

    /**
     * {@inheritdoc}
     * @return ApartadoAsientoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ApartadoAsientoQuery(get_called_class());
    }
}
