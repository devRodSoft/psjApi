<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "actor".
 *
 * @property int $id
 * @property string $nombre
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PeliculaActor[] $peliculaActors
 * @property Pelicula[] $peliculas
 */
class Actor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'actor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeliculaActors()
    {
        return $this->hasMany(PeliculaActor::className(), ['actor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeliculas()
    {
        return $this->hasMany(Pelicula::className(), ['id' => 'pelicula_id'])->viaTable('pelicula_actor', ['actor_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ActorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActorQuery(get_called_class());
    }
}
