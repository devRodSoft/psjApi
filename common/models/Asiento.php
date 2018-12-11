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
    public $ocupado = null;

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
            'nombre' => function ($m) {
                return sprintf('%s-%s', $m->fila, $m->numero);
            },
            'ocupado',
            'arreglo',
        ];
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
