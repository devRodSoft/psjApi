<?php

namespace common\models;

use common\models\PermisoQuery as PermisoQuery;
use common\models\Role as Role;
//use yii\rbac\Role as Role;
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

    const ACCESS_TAQUILLA              = 'acceso_taquilla';
    const ACCESS_REIMPRESION           = 'acceso_reimpresion';
    const ACCESS_ADMIN                 = 'acceso_admin';
    const ACCESS_VERIFICACION          = 'acceso_verificacion';
    const ACCESS_APARTAR               = 'access_apartar';
    const ACCESS_NUEVO_APARTADO        = 'access_nuevo_apartado';
    const ACCESS_REPORTES              = 'acceso_reportes';
    const ACCESS_PELICULAS             = 'acceso_peliculas';
    const ACCESS_PELICULAS_CREAR       = 'acceso_peliculas_crear';
    const ACCESS_ESTRENOS              = 'acceso_estrenos';
    const ACCESS_ESTRENOS_CREAR        = 'acceso_estrenos_crear';
    const ACCESS_USUARIOS              = 'acceso_usuarios';
    const ACCESS_USUARIOS_CREAR        = 'acceso_usuarios_crear';
    const ACCESS_FUNCIONES             = 'acceso_funciones';
    const ACCESS_FUNCIONES_CREAR       = 'acceso_funciones_crear';
    const ACCESS_PROMOCIONES           = 'acceso_promociones';
    const ACCESS_PROMOCIONES_CREAR     = 'acceso_promociones_crear';
    const ACCESS_BOLETOS               = 'acceso_boletos';
    const ACCESS_BOLETOS_CREAR         = 'acceso_boletos_crear';
    const ACCESS_DISTRIBUIDORAS        = 'acceso_distribuidoras';
    const ACCESS_DISTRIBUIDORAS_CREAR  = 'acceso_distribuidoras_crear';
    const ACCESS_CLASIFICACIONES       = 'acceso_clasificaciones';
    const ACCESS_CLASIFICACIONES_CREAR = 'acceso_clasificaciones_crear';
    const ACCESS_GENEROS               = 'acceso_generos';
    const ACCESS_GENEROS_CREAR         = 'acceso_generos_crear';
    const ACCESS_ROLES                 = 'acceso_roles';
    const ACCESS_ROLES_CREAR           = 'acceso_roles_crear';
    const ACCESS_SALAS                 = 'acceso_salas';
    const ACCESS_SALAS_CREAR           = 'acceso_salas_crear';
    const ACCESS_PRECIOS               = 'acceso_precios';
    const ACCESS_PRECIOS_CREAR         = 'acceso_precios_crear';
    const ACCESS_CINES                 = 'acceso_cines';
    const ACCESS_CINES_CREAR           = 'acceso_cines_crear';

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
            'nombre',
            'key',
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
