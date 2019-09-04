<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "permiso".
 *
 * @property int $id
 * @property string $nombre
 * @property string $key
 * @property string $descripcion
 *
 * @property RolePermiso[] $rolePermisos
 * @property Role[] $roles
 */
class Permiso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'permiso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'key', 'descripcion'], 'required'],
            [['nombre', 'key'], 'string'],
            [['descripcion'], 'string', 'max' => 255],
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
            'key' => 'Key',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'nombre' => 'Nombre',
            'key' => 'Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolePermisos()
    {
        return $this->hasMany(RolePermiso::className(), ['permiso_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(Role::className(), ['id' => 'role_id'])->viaTable('role_permiso', ['permiso_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PermisoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PermisoQuery(get_called_class());
    }
}
