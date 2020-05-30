<?php

use yii\db\Migration;

/**
 * Class m200530_155510_addPermisoPrintByCode
 */
class m200530_155510_addPermisoPrintByCode extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("INSERT INTO `permiso` (`nombre`,`key`,`descripcion`) VALUES
        ('Acceso a re imprecion por codigo','acceso_impresionCodigo','Acceso a poder buscar boletos por codigo')");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200530_155510_addPermisoPrintByCode cannot be reverted.\n";

        return false;
    }

}
