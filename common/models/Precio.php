<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "precio".
 *
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * @property string $default
 * @property string $especial
 * @property string $created_at
 * @property string $updated_at
 *
 * @property HorarioPrecio[] $horarioPrecios
 * @property HorarioFuncion[] $horarios
 */
class Precio extends \yii\db\ActiveRecord
{
    public $_fields = [
        'id',
        'nombre',
        'codigo',
        'default',
        'especial',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'precio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'codigo', 'default'], 'required'],
            [['default', 'especial'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre', 'codigo'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return $this->_fields;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'codigo' => 'Codigo',
            'default' => 'Default',
            'especial' => 'Especial',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarioPrecios()
    {
        return $this->hasMany(HorarioPrecio::className(), ['precio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarios()
    {
        return $this->hasMany(HorarioFuncion::className(), ['id' => 'horario_id'])->viaTable('horario_precio', ['precio_id' => 'id']);
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
