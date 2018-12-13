<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "asiento".
 *
 * @property int $id
 * @property string $fila
 * @property int $numero
 * @property int $tipo
 * @property string $arreglo
 *
 * @property SalaAsientos[] $salaAsientos
 */
class Asiento extends \yii\db\ActiveRecord
{
    public $ocupadoAsiento = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fila', 'numero', 'tipo', 'arreglo'], 'required'],
            [['numero', 'tipo'], 'integer'],
            [['arreglo'], 'string'],
            [['fila'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fila' => 'Fila',
            'numero' => 'Numero',
            'nombre' => 'asiento',
            'tipo' => 'Tipo',
            'arreglo' => 'Arreglo',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'id',
            'fila',
            'tipo',
            'numero',
            'nombre',
            'ocupado' => function ($m) {
                return $m->ocupadoAsiento == null ? null : ($m->ocupadoAsiento == '0' ? false : true);
            },
            'arreglo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombre()
    {
        return sprintf('%s-%s', $this->fila, $this->numero);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalaAsientos()
    {
        return $this->hasMany(SalaAsientos::className(), ['asiento_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return AsientoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AsientoQuery(get_called_class());
    }
}
