<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "estreno".
 *
 * @property int $id
 * @property int $cine_id
 * @property int $pelicula_id
 * @property string $inicio
 * @property string $fin
 * @property string $created_at
 * @property string $updated_at
 * @property int $publicar
 *
 * @property Cine $cine
 * @property Pelicula $pelicula
 */
class Estreno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estreno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cine_id', 'pelicula_id'], 'required'],
            [['cine_id', 'pelicula_id', 'publicar'], 'integer'],
            [['inicio', 'fin', 'created_at', 'updated_at'], 'safe'],
            [['cine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cine::className(), 'targetAttribute' => ['cine_id' => 'id']],
            [['pelicula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pelicula::className(), 'targetAttribute' => ['pelicula_id' => 'id']],
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
            'pelicula_id' => 'Pelicula ID',
            'inicio' => 'Inicio',
            'fin' => 'Fin',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'publicar' => 'Publicar',
        ];
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
    public function getPelicula()
    {
        return $this->hasOne(Pelicula::className(), ['id' => 'pelicula_id']);
    }

    /**
     * {@inheritdoc}
     * @return EstrenoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EstrenoQuery(get_called_class());
    }
}
