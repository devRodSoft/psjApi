<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "clasificacion".
 *
 * @property int $id
 * @property string $nombre
 * @property int $orden
 */
class Clasificacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clasificacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'orden'], 'required'],
            [['nombre'], 'string'],
            [['orden'], 'integer'],
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
            'orden' => 'Orden',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ClasificacionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClasificacionQuery(get_called_class());
    }
}
