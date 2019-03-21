<?php

use yii\db\Migration;

/**
 * Class m181016_210050_database_changes
 */
class m190122_210050_database_changes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `apiDB`.`funcion` CHANGE `recomendada` `recomendada` timestamp NULL DEFAULT NULL;");
        $this->execute("ALTER TABLE `apiDB`.`funcion` CHANGE `recomendada` `estreno` timestamp NULL DEFAULT NULL;");
        $this->execute("ALTER TABLE `apiDB`.`funcion` ADD COLUMN `publicar` BOOLEAN DEFAULT FALSE;");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return 1;
    }
}
