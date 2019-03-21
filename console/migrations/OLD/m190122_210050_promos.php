<?php

use yii\db\Migration;

/**
 * Class m181016_210050_database_changes
 */
class m190122_210050_promos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE TABLE IF NOT EXISTS `promocion` (
            `id` int(11) NOT NULL auto_increment,
            `cine_id` int(11) NOT NULL,
            `titulo` varchar(255) NOT NULL,
            `descripcion` text NOT NULL,
            `image_url` text NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `id` (`id`),
            KEY `idpromocion` (`id`)
        ) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;");
        $this->addForeignKey('promocion_cine_ref', 'promocion', 'cine_id', 'cine', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('promocion_cine_ref', 'promocion');
        $this->execute('DROP TABLE promocion');
    }
}
