<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cancelaciones".
 *
 * @property int $id
 * @property string $fechaCancelacion
 * @property string $nombreUsuario
 * @property string $pelicula
 * @property string $funcionFecha
 * @property string $funcionHora
 * @property string $sala
 * @property string $asiento
 * @property string $codigoBoleto
 * @property string $motivo
 */
class Cancelaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cancelaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fechaCancelacion'], 'safe'],
            [['nombreUsuario', 'pelicula', 'funcionFecha', 'funcionHora', 'sala', 'asiento', 'codigoBoleto', 'motivo'], 'required'],
            [['nombreUsuario', 'pelicula', 'funcionFecha', 'funcionHora', 'sala', 'asiento', 'codigoBoleto', 'motivo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fechaCancelacion' => 'Fecha Cancelacion',
            'nombreUsuario' => 'Nombre Usuario',
            'pelicula' => 'Pelicula',
            'funcionFecha' => 'Funcion Fecha',
            'funcionHora' => 'Funcion Hora',
            'sala' => 'Sala',
            'asiento' => 'Asiento',
            'codigoBoleto' => 'Codigo Boleto',
            'motivo' => 'Motivo',
        ];
    }
}