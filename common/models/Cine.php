<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cine".
 *
 * @property int $id
 * @property string $nombre
 * @property string $direccion
 * @property string $telefono
 *
 * @property Sala[] $salas
 */
class Cine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'direccion', 'telefono'], 'required'],
            [['nombre', 'direccion', 'telefono'], 'string'],
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
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarioFuncions()
    {
        return $this->hasMany(HorarioFuncion::className(), ['cine_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalas()
    {
        return $this->hasMany(Sala::className(), ['cine_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CineQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CineQuery(get_called_class());
    }
}
