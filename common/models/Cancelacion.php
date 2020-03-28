<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "actor".
 *
 * @property int $id
 * @property datetime $fechaCancelacion
 * @property string $nombreUsuario
 * @property string $pelicula
 * @property datetime $funcionFecha
 * @property datetime $funcionHora
 * @property string $sala
 * @property string $asiento
 * @property string $codigoBoleto
 * @property string $motivo
 *
 */
class Cancelacion extends \yii\db\ActiveRecord
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
            [['fechaCancelacion', 'nombreUsuario', 'pelicula', 'funcionFecha', 'funcionHora', 'sala', 'asiento', 'codigoBoleto', 'motivo'], 'required'],
            [['motivo'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fechaCancelacion' => 'fechaCancelacion',
            'nombreusuario' => 'nombreusuario',
            'pelicula' => 'pelicula',
            'funcionFecha' => 'funcionFecha',
            'funcionHora' => 'funcionHora',
            'sala' => 'sala',
            'asiento' => 'asiento',
            'codigoBoleto' => 'codigoBoleto',
            'motivo' => 'motivo'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'fechaCancelacion',
            'nombreusuario',
            'pelicula',
            'funcionFecha',
            'funcionHora',
            'sala',
            'asiento',
            'codigoBoleto',
            'motivo',
        ];
    }
}
