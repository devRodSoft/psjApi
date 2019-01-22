<?php

use yii\db\Migration;

/**
 * Class m181016_210050_database_changes
 */
class m181016_210050_database_changes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `funcion` ADD COLUMN `precio_niños` decimal(10,2) DEFAULT '30.00' COMMENT '';");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('ALTER TABLE `funcion` DROP COLUMN `precio_niños`;');
    }
}
