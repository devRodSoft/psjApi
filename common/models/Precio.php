<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Precio".
 *
 * @property int $id
 * @property string $nombre
 * @property string $default
 * @property string $especial
 */
class Precio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Precio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'default'], 'required'],
            [['default', 'especial'], 'number'],
            [['nombre'], 'string', 'max' => 45],
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
            'default' => 'Default',
            'especial' => 'Especial',
        ];
    }

    /**
     * {@inheritdoc}
     * @return PrecioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PrecioQuery(get_called_class());
    }
}
