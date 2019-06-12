<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "horario_funcion".
 *
 * @property int $id
 * @property int $funcion_id
 * @property int $sala_id
 * @property string $hora
 * @property string $fecha
 *
 * @property Boleto[] $boletos
 * @property Funcion $funcion
 * @property Sala $sala
 */
class HorarioFuncion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'horario_funcion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['funcion_id', 'sala_id', 'hora', 'fecha'], 'required'],
            [['funcion_id', 'sala_id'], 'integer'],
            [['hora', 'fecha'], 'safe'],
            [['funcion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Funcion::className(), 'targetAttribute' => ['funcion_id' => 'id']],
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
            'funcion_id' => 'Funcion ID',
            'sala_id' => 'Sala ID',
            'hora' => 'Hora',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoletos()
    {
        return $this->hasMany(Boleto::className(), ['horario_funcion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFuncion()
    {
        return $this->hasOne(Funcion::className(), ['id' => 'funcion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelicula()
    {
        return $this->hasOne(Pelicula::className(), ['id' => 'pelicula_id'])->via('funcion');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSala()
    {
        return $this->hasOne(Sala::className(), ['id' => 'sala_id']);
    }

    /**
     * {@inheritdoc}
     * @return HorarioFuncionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HorarioFuncionQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'id',
            'funcion_id',
            'sala_id',
            'sala',
            'hora' => function ($m) {
                return $m->getFHora();
            },
            'fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFHora()
    {
        return Yii::$app->formatter->asTime($this->hora, 'php:h:i A');
    }
}
