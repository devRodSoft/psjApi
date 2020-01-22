<?php

use yii\db\Migration;

/**
 * Class m181016_210050_database_changes
 */
class m200101_210050_permisos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {

        $this->execute("DELETE FROM role_permiso WHERE role_id IN (SELECT id FROM role WHERE nombre = 'administrador');");

        $this->execute("INSERT INTO `permiso` (`nombre`,`key`,`descripcion`) VALUES
          ('Acceso a listado de reportes','acceso_reportes','Acceso a listado de reportes'),
          ('Acceso a listado de peliculas','acceso_peliculas','Acceso a listado de peliculas'),
          ('Creacion y/o modificacion de peliculas','acceso_peliculas_crear','Creacion y/o modificacion de peliculas'),
          ('Acceso a listado de estrenos','acceso_estrenos','Acceso a listado de estrenos'),
          ('Creacion y/o modificacion de estrenos','acceso_estrenos_crear','Creacion y/o modificacion de estrenos'),
          ('Acceso a listado de usuarios','acceso_usuarios','Acceso a listado de usuarios'),
          ('Creacion y/o modificacion de usuarios','acceso_usuarios_crear','Creacion y/o modificacion de usuarios'),
          ('Acceso a listado de funciones','acceso_funciones','Acceso a listado de funciones'),
          ('Creacion y/o modificacion de funciones','acceso_funciones_crear','Creacion y/o modificacion de funciones'),
          ('Acceso a listado de promociones','acceso_promociones','Acceso a listado de promociones'),
          ('Creacion y/o modificacion de promociones','acceso_promociones_crear','Creacion y/o modificacion de promociones'),
          ('Acceso a listado de boletos','acceso_boletos','Acceso a listado de boletos'),
          ('Creacion y/o modificacion de boletos','acceso_boletos_crear','Creacion y/o modificacion de boletos'),
          ('Acceso a listado de distribuidoras','acceso_distribuidoras','Acceso a listado de distribuidoras'),
          ('Creacion y/o modificacion de distribuidoras','acceso_distribuidoras_crear','Creacion y/o modificacion de distribuidoras'),
          ('Acceso a listado de clasificaciones','acceso_clasificaciones','Acceso a listado de clasificaciones'),
          ('Creacion y/o modificacion de clasificaciones','acceso_clasificaciones_crear','Creacion y/o modificacion de clasificaciones'),
          ('Acceso a listado de generos','acceso_generos','Acceso a listado de generos'),
          ('Creacion y/o modificacion de generos','acceso_generos_crear','Creacion y/o modificacion de generos'),
          ('Acceso a listado de roles','acceso_roles','Acceso a listado de roles'),
          ('Creacion y/o modificacion de roles','acceso_roles_crear','Creacion y/o modificacion de roles'),
          ('Acceso a listado de salas','acceso_salas','Acceso a listado de salas'),
          ('Creacion y/o modificacion de salas','acceso_salas_crear','Creacion y/o modificacion de salas'),
          ('Acceso a listado de precios','acceso_precios','Acceso a listado de precios'),
          ('Creacion y/o modificacion de precios','acceso_precios_crear','Creacion y/o modificacion de precios'),
          ('Acceso a listado de cines','acceso_cines','Acceso a listado de cines'),
          ('Creacion y/o modificacion de cines','acceso_cines_crear','Creacion y/o modificacion de cines')");

        $this->execute("INSERT INTO `role_permiso` (`role_id`,
          `permiso_id`)
        SELECT role.id,
        permiso.id FROM permiso,
        role WHERE role.nombre = 'administrador' ;");

    }
}
