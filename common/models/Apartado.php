<?php

namespace common\models;

use common\models\HorarioFuncion as HorarioFuncion;
use common\models\SalaAsientos as SalaAsientos;
use Yii;
use yii\db\Query as Query;

/**
 * This is the model class for table "apartado".
 *
 * @property string $id
 * @property string $nombre
 * @property int $horario_funcion_id
 *
 * @property HorarioFuncion $horarioFuncion
 * @property ApartadoAsiento[] $apartadoAsientos
 */
class Apartado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apartado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['horario_funcion_id'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
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
            'nombre' => 'Nombre',
            'horario_funcion_id' => 'Horario Funcion ID',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'id',
            'nombre',
            'horarioFuncion',
            'hora' => function ($m) {
                return $m->horarioFuncion->fHora;
            },
            'fecha' => function ($m) {
                return $m->horarioFuncion->fecha;
            },
            'sala' => function ($m) {
                return $m->horarioFuncion->sala->nombre;
            },
            'pelicula' => function ($m) {
                return $m->horarioFuncion->pelicula->nombre;
            },
            'clasificacion' => function ($m) {
                return $m->horarioFuncion->pelicula->clasificacion;
            },
            'duracion' => function ($m) {
                return $m->horarioFuncion->pelicula->duracion;
            },
            'idioma' => function ($m) {
                return $m->horarioFuncion->pelicula->idioma;
            },
            'total',
            'asientos' => function ($m) {
                return $m->apartadoAsientos;
            },
        ];
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
    public function getApartadoAsientos()
    {
        return $this->hasMany(ApartadoAsiento::className(), ['apartado_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsientos()
    {
        return $this->hasMany(SalaAsientos::className(), ['id' => 'sala_asiento_id'])->via('apartadoAsientos');
    }

    public function getTotal()
    {

        $query = new Query;

        $query->select('SUM(aa.precio)')
            ->from(['aa' => ApartadoAsiento::tableName()])
            ->where(['aa.apartado_id' => $this->id])
            ->groupBy('aa.apartado_id');
        return $query->scalar();
    }

    /**
     * {@inheritdoc}
     * @return ApartadoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ApartadoQuery(get_called_class());
    }
}
