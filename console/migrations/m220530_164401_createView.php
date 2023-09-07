<?php

use yii\db\Migration;

/**
 * Class m220530_164401_createView
 */
class m220530_164401_createView extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE VIEW if not EXISTS vw_boletos AS
SELECT
b.id as boleto_id,
b.reclamado,
b.reimpreso,
b.created_at as boleto_creado,
b.updated_at as boleto_actualizado,
b.qr_phat,
b.hash,
b.horario_funcion_id,
sa.sala_id as sala_id,
f.cine_id as cine_id,
f.hora,
f.fecha,
f.publicar,
f.created_at as horario_creado,
f.updated_at as horario_actualizado,
p.id as precio_id,
p.nombre,
p.codigo,
p.created_at as precio_creado,
p.updated_at as precio_actualizado,
ba.precio as precio,
p.id as pago_id,
pa.create_time as create_time,
pa.id_pago_externo as id_pago_externo,
pa.intent,
pa.state,
pa.created_at as pago_creado,
pa.updated_at as pago_actualizado,
pa.tipo_pago as tipo_pago,
u.id as empleado_id,
u.username,
u.status as empleado_status,
u.created_at as empleado_creado,
u.updated_at as empleado_actualizado,
fu.id as cliente_id,
fu.status as cliente_status,
fu.created_at as cliente_creado,
fu.updated_at as cliente_actualizado,
f.pelicula_id as pelicula_id,
pe.nombre as nombre_pelicula,
pe.genero as genero,
pe.clasificacion clasificacion,
pe.idioma as idioma,
pe.duracion as duracion,
pe.distribuidora_id as distribuidora_id,
d.nombre as nombre_distribuidor

FROM 
boleto b
inner join boleto_asiento ba on ba.boleto_id = b.id
inner join horario_funcion f on f.id = b.horario_funcion_id
inner JOIN horario_precio hp on hp.horario_id = f.id
INNER JOIN precio p on p.id = hp.precio_id
INNER JOIN pago pa on pa.id = b.id_pago
inner join `user` u on u.id = b.user_id
INNER JOIN face_user fu on fu.id = pa.face_user_id
INNER JOIN pelicula pe on pe.id = f.pelicula_id
INNER join distribuidora d on d.id = pe.distribuidora_id
INNER join sala_asientos sa on sa.id = ba.sala_asiento_id 
");
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220530_164401_createView cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220530_164401_createView cannot be reverted.\n";

        return false;
    }
    */
}
