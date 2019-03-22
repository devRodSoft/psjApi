<?php

use yii\db\Migration;

/**
 * Class m181016_210050_database_changes
 */
class m190322_210050_reset_database extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {

        $this->execute("ALTER TABLE `apiDB`.`pago` DROP FOREIGN KEY `pagoBoleto_ref`;
          ALTER TABLE `apiDB`.`pago` DROP COLUMN `boleto_id`;");

        $this->db->close();
        $this->db->open();
    }
}
