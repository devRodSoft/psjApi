<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "role_permiso".
 *
 * @property int $role_id
 * @property int $permiso_id
 *
 * @property Permiso $permiso
 * @property Role $role
 */
class RolePermiso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role_permiso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'permiso_id'], 'required'],
            [['role_id', 'permiso_id'], 'integer'],
            [['role_id', 'permiso_id'], 'unique', 'targetAttribute' => ['role_id', 'permiso_id']],
            [['permiso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Permiso::className(), 'targetAttribute' => ['permiso_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'permiso_id' => 'Permiso ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermiso()
    {
        return $this->hasOne(Permiso::className(), ['id' => 'permiso_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    /**
     * {@inheritdoc}
     * @return RolePermisoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RolePermisoQuery(get_called_class());
    }
}
