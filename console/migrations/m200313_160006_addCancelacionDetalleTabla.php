<?php

use yii\db\Migration;

/**
 * Class m200313_160006_addCancelacionDetalleTabla
 */
class m200313_160006_addCancelacionDetalleTabla extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //Cancelaciones
        $this->createTable('cancelaciones', [
            'id'               => $this->primaryKey(),
            'fechaCancelacion' => $this->datetime(),
            'nombreUsuario'    => $this->string()->notNull(),
            'pelicula'         => $this->string()->notNull(),
            'funcionFecha'     => $this->string()->notNull(),
            'funcionHora'      => $this->string()->notNull(),
            'sala'             => $this->string()->notNull(),      
            'asiento'          => $this->string()->notNull(),      
            'codigoBoleto'     => $this->string()->notNull(),
            'motivo'           => $this->string()->notNull(), 
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200313_160006_addCancelacionDetalleTabla cannot be reverted.\n";

        return false;
    }
}
