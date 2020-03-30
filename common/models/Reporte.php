<?php

namespace common\models;

use common\models\Sala as Sala;
use Yii;
use yii\db\Query;

/**
 * This is the model class for table "boleto".
 *
 **/
class Reporte extends \yii\db\ActiveRecord
{
    public $conteo      = 0;
    public $total       = 0;
    public $fecha_venta = "";
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_boletos';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'boleto_id'            => 'Boleto ID',
            'reclamado'            => 'Reclamado',
            'reimpreso'            => 'Reimpreso',
            'boleto_creado'        => 'Fecha de venta de boleto',
            'boleto_actualizado'   => 'Boleto actualizado',
            'qr_phat'              => 'Qr phat',
            'hash'                 => 'Hash',
            'horario_funcion_id'   => 'Horario funcion ID',
            'sala_id'              => 'Sala ID',
            'cine_id'              => 'Cine ID',
            'hora'                 => 'Hora',
            'fecha'                => 'Fecha',
            'publicar'             => 'Publicar',
            'horario_creado'       => 'Horario creado',
            'horario_actualizado'  => 'Horario actualizado',
            'precio_id'            => 'Precio ID',
            'nombre'               => 'Precio aplicado',
            'codigo'               => 'Precio codigo',
            'precio_creado'        => 'Precio creado',
            'precio_actualizado'   => 'Precio actualizado',
            'precio'               => 'Precio',
            'pago_id'              => 'Pago ID',
            'create_time'          => 'Create time',
            'id_pago_externo'      => 'Id pago externo',
            'intent'               => 'Intent',
            'state'                => 'State',
            'pago_creado'          => 'Pago creado',
            'pago_actualizado'     => 'Pago actualizado',
            'tipo_pago'            => 'Tipo pago',
            'empleado_id'          => 'Empleado ID',
            'username'             => 'Empleado',
            'empleado_status'      => 'Empleado status',
            'empleado_creado'      => 'Empleado creado',
            'empleado_actualizado' => 'Empleado actualizado',
            'cliente_id'           => 'Cliente ID',
            'cliente_status'       => 'Cliente status',
            'cliente_creado'       => 'Cliente creado',
            'cliente_actualizado'  => 'Cliente actualizado',
            'pelicula_id'          => 'Pelicula ID',
            'nombre_pelicula'      => 'Nombre pelicula',
            'genero'               => 'Genero',
            'clasificacion'        => 'Clasificacion',
            'idioma'               => 'Idioma',
            'duracion'             => 'Duracion',
            'distribuidora_id'     => 'Distribuidora ID',
            'nombre_distribuidor'  => 'Nombre distribuidor',
            'conteo'               => 'Cantidad',
            'total'                => 'Total',
            'fecha_venta'          => 'Fecha de venta',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ReportesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReportesQuery(get_called_class());
    }

    public function getSala()
    {
        return $this->hasOne(Sala::className(), ['id' => 'sala_id']);
    }
}
