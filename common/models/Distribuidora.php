<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "distribuidora".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Pelicula[] $peliculas
 */
class Distribuidora extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'distribuidora';
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
            'nombre' => 'distribuidora',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeliculas()
    {
        return $this->hasMany(Pelicula::className(), ['distribuidora' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return DistribuidoraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DistribuidoraQuery(get_called_class());
    }
}
