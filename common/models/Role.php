<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 *
 * @property RolePermiso[] $rolePermisos
 * @property Permiso[] $permisos
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'required'],
            [['nombre'], 'string'],
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
            'nombre' => 'Nivel de permisos',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolePermisos()
    {
        return $this->hasMany(RolePermiso::className(), ['role_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermisos()
    {
        return $this->hasMany(Permiso::className(), ['id' => 'permiso_id'])->viaTable('role_permiso', ['role_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function savePermisos($newPermisos)
    {

        RolePermiso::deleteAll('role_id = :roleID', [':roleID' => $this->id]);

        $permisos = Permiso::find()->where(['in', 'id', $newPermisos])->all();

        foreach ($permisos as $permiso) {

            $roleP             = new RolePermiso();
            $roleP->role_id    = $this->id;
            $roleP->permiso_id = $permiso->id;

            if (!$roleP->save()) {

                Yii::$app->session->setFlash('error', "Tienes un error con los permisos que ingresaste");
                return false;
            }
        }
        return true;
    }

    /**
     * {@inheritdoc}
     * @return RoleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RoleQuery(get_called_class());
    }
}
