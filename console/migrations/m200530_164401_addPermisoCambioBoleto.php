<?php

use yii\db\Migration;

/**
 * Class m200530_164401_addPermisoCambioBoleto
 */
class m200530_164401_addPermisoCambioBoleto extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("INSERT INTO `permiso` (`nombre`,`key`,`descripcion`) VALUES
        ('Acceso a cambio de boletos','acceso_cambio','Acceso a poder cambiar un boleto')");
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200530_164401_addPermisoCambioBoleto cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200530_164401_addPermisoCambioBoleto cannot be reverted.\n";

        return false;
    }
    */
}
