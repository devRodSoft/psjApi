<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "promocion".
 *
 * @property int $id
 * @property int $cine_id
 * @property string $titulo
 * @property string $descripcion
 * @property string $image_url
 * @property string $start_date
 * @property string $end_date
 * @property string $bases
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Cine $cine
 */
class Promocion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promocion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cine_id', 'titulo', 'descripcion', 'image_url', 'bases'], 'required'],
            [['cine_id'], 'integer'],
            [['descripcion', 'image_url'], 'string'],
            [['start_date', 'end_date', 'created_at', 'updated_at'], 'safe'],
            [['titulo', 'bases'], 'string', 'max' => 255],
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
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'image_url' => 'Imagen Url',
            'start_date' => 'fecha de inicio',
            'end_date' => 'Fecha fin ',
            'bases' => 'Bases',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'id',
            'cine_id',
            'titulo',
            'bases',
            'descripcion',
            'image_url',
            'inicio' => function ($m) {
                return \DateTime::createFromFormat('Y-m-d H:m:s', $m->start_date)->format('c');
            },
            'fin' => function ($m) {
                return \DateTime::createFromFormat('Y-m-d H:m:s', $m->end_date)->format('c');
            },
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
     * {@inheritdoc}
     * @return PromocionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PromocionQuery(get_called_class());
    }
}
