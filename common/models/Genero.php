<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "genero".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property PeliculaGenero[] $peliculaGeneros
 */
class Genero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genero';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeliculaGeneros()
    {
        return $this->hasMany(PeliculaGenero::className(), ['genero_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return GeneroQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GeneroQuery(get_called_class());
    }
}
