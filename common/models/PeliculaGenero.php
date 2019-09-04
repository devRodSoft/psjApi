<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pelicula_genero".
 *
 * @property int $pelicula_id
 * @property int $genero_id
 *
 * @property Pelicula $pelicula
 * @property Genero $genero
 */
class PeliculaGenero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pelicula_genero';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pelicula_id', 'genero_id'], 'required'],
            [['pelicula_id', 'genero_id'], 'integer'],
            [['pelicula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pelicula::className(), 'targetAttribute' => ['pelicula_id' => 'id']],
            [['genero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::className(), 'targetAttribute' => ['genero_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pelicula_id' => 'Pelicula ID',
            'genero_id' => 'Genero ID',
        ];
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
    public function getGenero()
    {
        return $this->hasOne(Genero::className(), ['id' => 'genero_id']);
    }

    /**
     * {@inheritdoc}
     * @return PeliculaGeneroQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PeliculaGeneroQuery(get_called_class());
    }
}
