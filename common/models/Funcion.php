<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "funcion".
 *
 * @property int $id
 * @property int $cine_id
 * @property int $pelicula_id
 * @property int $sala_id
 * @property string $precio
 * @property string $estreno_inicio
 * @property string $estreno_fin
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Cine $cine
 * @property Pelicula $pelicula
 * @property Sala $sala
 * @property HorarioFuncion[] $horarios
 */
class Funcion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'funcion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cine_id', 'pelicula_id', 'precio'], 'required'],
            [['cine_id', 'pelicula_id', 'publicar'], 'integer'],
            [['precio', 'precio_niños'], 'number'],
            [['estreno_inicio', 'estreno_fin', 'created_at', 'updated_at'], 'safe'],
            [['cine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cine::className(), 'targetAttribute' => ['cine_id' => 'id']],
            [['pelicula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pelicula::className(), 'targetAttribute' => ['pelicula_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cine_id' => 'Cine ID',
            'pelicula_id' => 'Pelicula ID',
            'precio' => 'Precio',
            'estreno_inicio' => 'Estreno inicia',
            'estreno_fin' => 'Estreno termina',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
        ];
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
    public function getPelicula()
    {
        return $this->hasOne(Pelicula::className(), ['id' => 'pelicula_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarios()
    {
        return $this->hasMany(HorarioFuncion::className(), ['funcion_id' => 'id'])->ordered();
    }

    /**
     * {@inheritdoc}
     * @return FuncionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FuncionQuery(get_called_class());
    }
}
