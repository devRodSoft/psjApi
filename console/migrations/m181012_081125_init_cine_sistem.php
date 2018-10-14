<?php

use yii\db\Migration;

/**
 * Class m181012_081125_init_cine_sistem
 */
class m181012_081125_init_cine_sistem extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE TABLE IF NOT EXISTS `role` (
        `id` int(11) NOT NULL auto_increment,
        `nombre` tinytext NOT NULL,
        `descripcion` varchar(255) NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `id` (`id`),
        KEY `idrole` (`id`)
        ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;");

        $this->execute("INSERT INTO `role` (`id`, `nombre`, `descripcion`) VALUES ('1', 'Administrador', 'God');");

        $this->execute("CREATE TABLE IF NOT EXISTS `permiso` (
        `id` int(11) NOT NULL auto_increment,
        `nombre` tinytext NOT NULL,
        `key` tinytext NOT NULL,
        `descripcion` varchar(255) NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `id` (`id`),
        KEY `idpermiso` (`id`)
        ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;");

        $this->execute("CREATE TABLE IF NOT EXISTS `role_permiso` (
        `role_id` int(11) NOT NULL,
        `permiso_id` int(11) NOT NULL,
        PRIMARY KEY (`role_id`, `permiso_id`),
        UNIQUE KEY `permisionrole` (`role_id`, `permiso_id`),
        KEY `idpermiso` (`role_id`, `permiso_id`)
        ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;");

        $this->addForeignKey('roled', 'role_permiso', 'role_id', 'role', 'id');
        $this->addForeignKey('permission', 'role_permiso', 'permiso_id', 'permiso', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('roled', 'role_permiso');
        $this->dropForeignKey('permission', 'role_permiso');

        $this->execute('DROP TABLE IF EXISTS role_permiso');
        $this->execute('DROP TABLE IF EXISTS role');
        $this->execute('DROP TABLE IF EXISTS permiso');
    }
}
