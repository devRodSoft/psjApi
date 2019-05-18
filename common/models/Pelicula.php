<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pelicula".
 *
 * @property int $id
 * @property string $nombre
 * @property int $director_id
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
 * @property Director $director
 * @property PeliculaActor[] $peliculaActors
 * @property Actor[] $actors
 */
class Pelicula extends \yii\db\ActiveRecord
{
    public $estreno_inicio = null;
    public $estreno_fin    = null;
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
            [['nombre', 'director_id', 'genero', 'calificacion', 'clasificacion', 'idioma', 'duracion', 'sinopsis', 'cartelUrl', 'trailerUrl', 'trailerImg'], 'required'],
            [['director_id'], 'integer'],
            [['genero', 'clasificacion', 'idioma', 'duracion', 'sinopsis', 'cartelUrl', 'trailerUrl', 'trailerImg'], 'string'],
            [['calificacion'], 'number'],
            [['created_at', 'updated_at', 'estreno_inicio', 'estreno_fin'], 'safe'],
            [['nombre'], 'string', 'max' => 150],
            [['director_id'], 'exist', 'skipOnError' => true, 'targetClass' => Director::className(), 'targetAttribute' => ['director_id' => 'id']],
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
            'director_id' => 'Director ID',
            'genero' => 'Genero',
            'calificacion' => 'Calificacion',
            'clasificacion' => 'Clasificacion',
            'idioma' => 'Idioma',
            'duracion' => 'Duracion',
            'sinopsis' => 'Sinopsis',
            'cartelUrl' => 'Cartel Url',
            'trailerUrl' => 'Trailer Url',
            'trailerImg' => 'Trailer Img',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
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
     * @return \yii\db\ActiveQuery
     */
    public function getDirector()
    {
        return $this->hasOne(Director::className(), ['id' => 'director_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeliculaActors()
    {
        return $this->hasMany(PeliculaActor::className(), ['pelicula_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReparto()
    {
        return $this->hasMany(Actor::className(), ['id' => 'actor_id'])->viaTable('pelicula_actor', ['pelicula_id' => 'id']);
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
