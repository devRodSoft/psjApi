<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "horario_funcion".
 *
 * @property int $id
 * @property int $sala_id
 * @property int $cine_id
 * @property int $pelicula_id
 * @property string $hora
 * @property string $fecha
 * @property int $publicar
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Boleto[] $boletos
 * @property Pelicula $pelicula
 * @property Cine $cine
 * @property Sala $sala
 * @property HorarioPrecio[] $horarioPrecios
 * @property Precio[] $precios
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
            [['sala_id', 'cine_id', 'pelicula_id', 'hora', 'fecha'], 'required'],
            [['sala_id', 'cine_id', 'pelicula_id', 'publicar'], 'integer'],
            [['hora', 'fecha', 'created_at', 'updated_at'], 'safe'],
            [['pelicula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pelicula::className(), 'targetAttribute' => ['pelicula_id' => 'id']],
            [['cine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cine::className(), 'targetAttribute' => ['cine_id' => 'id']],
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
            'cine_id' => 'Cine ID',
            'pelicula_id' => 'Pelicula ID',
            'hora' => 'Hora',
            'fecha' => 'Fecha',
            'publicar' => 'Publicar',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
    public function getPelicula()
    {
        return $this->hasOne(Pelicula::className(), ['id' => 'pelicula_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCine()
    {
        return $this->hasOne(Cine::className(), ['id' => 'cine_id']);
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
    public function getHorarioPrecios()
    {
        return $this->hasMany(HorarioPrecio::className(), ['horario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrecios()
    {
        return $this->hasMany(Precio::className(), ['id' => 'precio_id'])->viaTable('horario_precio', ['horario_id' => 'id']);
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
            'sala_id',
            'cine_id',
            'pelicula_id',
            'fecha',
            'publicar',
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
