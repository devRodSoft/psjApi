<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sala".
 *
 * @property int $id
 * @property int $cine_id
 * @property string $nombre
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Funcion[] $funcions
 * @property Cine $cine
 * @property SalaAsientos[] $salaAsientos
 */
class Sala extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sala';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cine_id', 'nombre'], 'required'],
            [['cine_id'], 'integer'],
            [['nombre'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['cine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cine::className(), 'targetAttribute' => ['cine_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cine_id' => 'Cine ID',
            'nombre' => 'Nombre',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFuncions()
    {
        return $this->hasMany(Funcion::className(), ['sala_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCine()
    {
        return $this->hasOne(Cine::className(), ['id' => 'cine_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalaAsientos()
    {
        return $this->hasMany(SalaAsientos::className(), ['sala_id' => 'id']);
    }

    public function getAsientosAsMtx()
    {
        $salaAsientos = $this->getSalaAsientos()->orderBy(['fila' => SORT_DESC, 'numero' => SORT_ASC])->all();
        $filas        = [];
        foreach ($salaAsientos as $asiento) {
            $filas[$asiento->fila][] = $asiento;
        }
        return $filas;
    }

    /**
     * {@inheritdoc}
     * @return SalaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SalaQuery(get_called_class());
    }
}
