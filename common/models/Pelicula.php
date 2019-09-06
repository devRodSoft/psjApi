<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pelicula".
 *
 * @property int $id
 * @property string $nombre
 * @property int $distribuidora_id
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
 * @property Estreno[] $estrenos
 * @property HorarioFuncion[] $horarioFuncions
 * @property Distribuidora $distribuidora
 * @property PeliculaActor[] $peliculaActors
 * @property Actor[] $actors
 */
class Pelicula extends \yii\db\ActiveRecord
{
    public $_genero;
    public $imageFile;
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
            [['nombre', 'distribuidora_id', 'clasificacion', 'idioma', 'duracion', 'sinopsis', 'cartelUrl', 'trailerUrl', 'genero'], 'required'],
            [['distribuidora_id'], 'integer'],
            [['clasificacion', 'idioma', 'genero', 'duracion', 'sinopsis', 'cartelUrl', 'trailerUrl', 'trailerImg'], 'string'],
            [['calificacion'], 'number'],
            [['created_at', 'updated_at', 'genero'], 'safe'],
            [['nombre'], 'string', 'max' => 150],
            [['distribuidora_id'], 'exist', 'skipOnError' => true, 'targetClass' => Distribuidora::className(), 'targetAttribute' => ['distribuidora_id' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre Pelicula',
            'distribuidora_id' => 'Distribuidora ID',
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
    public function getEstrenos()
    {
        return $this->hasMany(Estreno::className(), ['pelicula_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarioFuncions()
    {
        return $this->hasMany(HorarioFuncion::className(), ['pelicula_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistribuidora()
    {
        return $this->hasOne(Distribuidora::className(), ['id' => 'distribuidora_id']);
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
    public function getActors()
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

    public function upload()
    {
        if ($this->validate(['imageFile'])) {
            $this->cartelUrl = Yii::$app->params['uploadsUrl'].'/peliculas/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            return $this->imageFile->saveAs(Yii::getAlias('@api/web/peliculas/' . $this->imageFile->baseName . '.' . $this->imageFile->extension));
             true;
        } else {
            return false;
        }
    }


    public function afterSave($insert, $changedAttr)
    {
        return Parent::afterSave($insert, $changedAttr);
    }
}
