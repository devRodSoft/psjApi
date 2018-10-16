<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pelicula".
 *
 * @property int $id
 * @property string $nombre
 * @property string $director
 * @property string $reparto
 * @property string $genero
 * @property string $calificacion
 * @property string $clasificacion
 * @property string $idioma
 * @property string $duracion
 * @property string $sinopsis
 * @property string $cartelUrl
 * @property string $trailerUrl
 * @property string $trailerImg
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Funcion[] $funcions
 */
class Pelicula extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pelicula';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'director', 'reparto', 'genero', 'calificacion', 'clasificacion', 'idioma', 'duracion', 'sinopsis', 'cartelUrl', 'trailerUrl', 'trailerImg'], 'required'],
            [['director', 'reparto', 'genero', 'clasificacion', 'idioma', 'duracion', 'sinopsis', 'cartelUrl', 'trailerUrl', 'trailerImg'], 'string'],
            [['calificacion'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 150],
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
            'director' => 'Director',
            'reparto' => 'Reparto',
            'genero' => 'Genero',
            'calificacion' => 'Calificacion',
            'clasificacion' => 'Clasificacion',
            'idioma' => 'Idioma',
            'duracion' => 'Duracion',
            'sinopsis' => 'Sinopsis',
            'cartelUrl' => 'Cartel Url',
            'trailerUrl' => 'Trailer Url',
            'trailerImg' => 'Trailer Img',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFuncions()
    {
        return $this->hasMany(Funcion::className(), ['pelicula_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PeliculaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PeliculaQuery(get_called_class());
    }
}
