<?php

use yii\db\Migration;

/**
 * Class m181016_210050_database_changes
 */
class m200329_210051_permissions_cancelar extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {

        $this->execute("INSERT INTO `permiso` (`nombre`,`key`,`descripcion`) VALUES
          ('Acceso a cancelacion de boletos','acceso_taquilla_boletos_cancelar','Acceso a cancelacion de boletos')");

        $this->execute("INSERT INTO `role_permiso` (`role_id`, `permiso_id`)
        SELECT role.id,
        permiso.id FROM permiso, role
        WHERE role.nombre = 'administrador' AND permiso.nombre = 'acceso_taquilla_boletos_cancelar';");

    }
}
