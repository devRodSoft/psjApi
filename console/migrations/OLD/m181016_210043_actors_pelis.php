<?php

use yii\db\Migration;

/**
 * Class m181016_210043_actors_pelis
 */
class m181016_210043_actors_pelis extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'pelicula_actor',
            ['pelicula_id', 'actor_id'],
            [
                ['1', '1'],
                ['1', '2'],
                ['1', '3'],
                ['2', '1'],
                ['2', '6'],
                ['2', '8'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('DELETE FROM pelicula_actor');
    }
}
