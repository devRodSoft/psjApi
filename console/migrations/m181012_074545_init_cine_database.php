<?php

use yii\db\Migration;

/**
 * Class m181012_074545_init_cine_database
 */
class m181012_074545_init_cine_database extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->execute("CREATE TABLE IF NOT EXISTS `funcion` (
        `id` int(11) NOT NULL auto_increment,
        `cine_id` int(11) NOT NULL,
        `pelicula_id` int(11) NOT NULL,
        `sala_id` int(11) NOT NULL,
        `precio` decimal(10,2) NOT NULL,
        `recomendada` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        UNIQUE KEY `id` (`id`),
        KEY `idfuncion` (`id`)
        ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;");

        $this->execute("CREATE TABLE IF NOT EXISTS `horario_funcion` (
        `id` int(11) NOT NULL auto_increment,
        `funcion_id` int(11) NOT NULL,
        `hora` time NOT NULL,
        `fecha` date NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `id` (`id`),
        KEY `idhorarioFuncion` (`id`)
        ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;");

        $this->execute("CREATE TABLE IF NOT EXISTS `sala` (
        `id` int(11) NOT NULL auto_increment,
        `cine_id` int(11) NOT NULL,
        `nombre` tinytext NOT NULL,
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        UNIQUE KEY `id` (`id`),
        KEY `idsala` (`id`)
        ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;");

        $this->execute("CREATE TABLE IF NOT EXISTS `sala_asientos` (
        `id` int(11) NOT NULL auto_increment,
        `sala_id` int(11) NOT NULL,
        `asiento_id` int(11) NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `id` (`id`),
        KEY `idsalaasiento` (`id`)
        ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;");

        $this->execute("CREATE TABLE IF NOT EXISTS `asiento` (
        `id` int(11) NOT NULL auto_increment,
        `fila` char(1) NOT NULL,
        `numero` int(11) NOT NULL,
        `arreglo` tinytext NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `id` (`id`),
        KEY `idasiento` (`id`)
        ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;");

        $this->execute("CREATE TABLE IF NOT EXISTS `cine` (
        `id` int(11) NOT NULL auto_increment,
        `nombre` tinytext NOT NULL,
        `direccion` tinytext NOT NULL,
        `telefono` tinytext NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `id` (`id`),
        KEY `idcine` (`id`)
        ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;");

        $this->execute("CREATE TABLE IF NOT EXISTS `pelicula` (
        `id` int(11) NOT NULL auto_increment,
        `nombre` VARCHAR(150) NOT NULL,
        `director` int(11) NOT NULL,
        `genero` tinytext NOT NULL,
        `calificacion` DECIMAL(2,1) NOT NULL,
        `clasificacion` tinytext NOT NULL,
        `idioma` tinytext NOT NULL,
        `duracion` tinytext NOT NULL,
        `sinopsis` text NOT NULL,
        `cartelUrl` text NOT NULL,
        `trailerUrl` text NOT NULL,
        `trailerImg` text NOT NULL,
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        UNIQUE KEY `id` (`id`),
        KEY `idpelicula` (`id`)
        ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;");

        $this->execute("CREATE TABLE IF NOT EXISTS `actor` (
        `id` int(11) NOT NULL auto_increment,
        `nombre` VARCHAR(150) NOT NULL,
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        UNIQUE KEY `id` (`id`),
        KEY `idactores` (`id`)
        ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;");

        $this->execute("CREATE TABLE IF NOT EXISTS `director` (
        `id` int(11) NOT NULL auto_increment,
        `nombre` VARCHAR(150) NOT NULL,
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        UNIQUE KEY `id` (`id`),
        KEY `iddirectores` (`id`)
        ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;");

        $this->execute("CREATE TABLE IF NOT EXISTS `pelicula_director` (
        `pelicula_id` int(11) NOT NULL,
        `director_id` int(11) NOT NULL,
        PRIMARY KEY (`pelicula_id`, `director_id`),
        UNIQUE KEY `id` (`pelicula_id`, `director_id`),
        KEY `idpeliculadirector` (`pelicula_id`, `director_id`)
        ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;");

        $this->execute("CREATE TABLE IF NOT EXISTS `pelicula_actor` (
        `pelicula_id` int(11) NOT NULL,
        `actor_id` int(11) NOT NULL,
        PRIMARY KEY (`pelicula_id`, `actor_id`),
        UNIQUE KEY `id` (`pelicula_id`, `actor_id`),
        KEY `idpeliculaactor` (`pelicula_id`, `actor_id`)
        ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute(" DROP TABLE IF EXISTS `funcion`");
        $this->execute(" DROP TABLE IF EXISTS `horario_funcion`");
        $this->execute(" DROP TABLE IF EXISTS `sala`");
        $this->execute(" DROP TABLE IF EXISTS `sala_asientos`");
        $this->execute(" DROP TABLE IF EXISTS `asiento`");
        $this->execute(" DROP TABLE IF EXISTS `cine`");
        $this->execute(" DROP TABLE IF EXISTS `pelicula`");
    }
}
