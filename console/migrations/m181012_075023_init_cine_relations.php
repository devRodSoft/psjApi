<?php

use yii\db\Migration;

/**
 * Class m181012_075023_init_cine_relations
 */
class m181012_075023_init_cine_relations extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('funcion_cine', 'funcion', 'cine_id', 'cine', 'id');
        $this->addForeignKey('funcion_pelicula', 'funcion', 'pelicula_id', 'pelicula', 'id');
        $this->addForeignKey('horario_funcion_rel', 'horario_funcion', 'funcion_id', 'funcion', 'id');

        $this->addForeignKey('horarios_sala_rel', 'horario_funcion', 'sala_id', 'sala', 'id');
        $this->addForeignKey('pelicula_director', 'pelicula', 'director_id', 'director', 'id');
        $this->addForeignKey('pelicula_actor_ref', 'pelicula_actor', 'pelicula_id', 'pelicula', 'id');
        $this->addForeignKey('pelicula_actor', 'pelicula_actor', 'actor_id', 'actor', 'id');

        $this->addForeignKey('sala_cine', 'sala', 'cine_id', 'cine', 'id');
        $this->addForeignKey('sala_ref', 'sala_asientos', 'sala_id', 'sala', 'id');
        $this->addForeignKey('asientos_ref', 'sala_asientos', 'asiento_id', 'asiento', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('funcion_cine', 'funcion');
        $this->dropForeignKey('funcion_pelicula', 'funcion');
        $this->dropForeignKey('funcion_sala', 'funcion');
        $this->dropForeignKey('horario_funcion_rel', 'horario_funcion');
        $this->dropForeignKey('sala_cine', 'sala');
        $this->dropForeignKey('sala_ref', 'sala_asientos');
        $this->dropForeignKey('asientos_ref', 'sala_asientos');

        $this->dropForeignKey('pelicula_director', 'pelicula');
        $this->dropForeignKey('pelicula_actor_ref', 'pelicula_actor');
        $this->dropForeignKey('pelicula_actor', 'pelicula_actor');
    }
}
