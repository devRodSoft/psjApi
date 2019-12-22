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

        $this->execute("ALTER TABLE `boleto` ADD COLUMN `qr_phat` VARCHAR(255) NULL DEFAULT NULL COMMENT 'ruta al qr de la operacion';");
        $this->execute("ALTER TABLE `boleto` ADD COLUMN `hash` VARCHAR(255) NULL DEFAULT NULL COMMENT 'hash de la operacion';");

        $this->db->close();
        $this->db->open();
    }
}
