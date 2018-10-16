<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pelicula_actor".
 *
 * @property int $pelicula_id
 * @property int $actor_id
 *
 * @property Actor $actor
 * @property Pelicula $pelicula
 */
class PeliculaActor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pelicula_actor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pelicula_id', 'actor_id'], 'required'],
            [['pelicula_id', 'actor_id'], 'integer'],
            [['pelicula_id', 'actor_id'], 'unique', 'targetAttribute' => ['pelicula_id', 'actor_id']],
            [['actor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Actor::className(), 'targetAttribute' => ['actor_id' => 'id']],
            [['pelicula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pelicula::className(), 'targetAttribute' => ['pelicula_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pelicula_id' => 'Pelicula ID',
            'actor_id' => 'Actor ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActor()
    {
        return $this->hasOne(Actor::className(), ['id' => 'actor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelicula()
    {
        return $this->hasOne(Pelicula::className(), ['id' => 'pelicula_id']);
    }

    /**
     * {@inheritdoc}
     * @return PeliculaActorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PeliculaActorQuery(get_called_class());
    }
}
