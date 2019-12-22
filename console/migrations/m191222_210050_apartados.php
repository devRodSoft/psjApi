<?php

use yii\db\Migration;

/**
 * Class m181016_210050_database_changes
 */
class m191222_210050_apartados extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {

        $this->execute("CREATE TABLE `apartado` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `horario_funcion_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `horario_funcion_id` (`horario_funcion_id`),
  CONSTRAINT `apartado_ibfk_1` FOREIGN KEY (`horario_funcion_id`) REFERENCES `horario_funcion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8");

        $this->execute("CREATE TABLE `apartado_asiento` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sala_asiento_id` int(11) NOT NULL,
  `precio_id` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `horario_funcion_id` int(11) NOT NULL,
  `apartado_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `apartado_asiento_horario_funcion_id_sala_asiento_id_idx` (`horario_funcion_id`,`sala_asiento_id`) USING BTREE,
  KEY `sala_asiento_id` (`sala_asiento_id`),
  KEY `precio_id` (`precio_id`),
  KEY `apartado_id` (`apartado_id`),
  CONSTRAINT `apartado_asiento_ibfk_1` FOREIGN KEY (`sala_asiento_id`) REFERENCES `sala_asientos` (`id`),
  CONSTRAINT `apartado_asiento_ibfk_2` FOREIGN KEY (`precio_id`) REFERENCES `precio` (`id`),
  CONSTRAINT `apartado_asiento_ibfk_3` FOREIGN KEY (`apartado_id`) REFERENCES `apartado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

        $this->execute("INSERT INTO `permiso` (`nombre`, `key`, `descripcion`) VALUES ('Acceso a lista de apartados', 'access_apartar', 'Acceso a lista de  apartados en Taquilla')");
        $this->execute("INSERT INTO `permiso` (`nombre`, `key`, `descripcion`) VALUES ('Acceso a creacion de apartados', 'access_nuevo_apartado', 'Acceso a creacion de apartados en Taquilla')");
        $this->execute("ALTER TABLE `boleto` CHANGE `created_at` `created_at` timestamp NOT NULL DEFAULT current_timestamp()");

    }
}
