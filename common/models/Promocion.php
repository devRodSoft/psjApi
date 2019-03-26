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
            [['cine_id', 'titulo', 'descripcion', 'image_url'], 'required'],
            [['cine_id'], 'integer'],
            [['descripcion', 'image_url'], 'string'],
            [['titulo'], 'string', 'max' => 255],
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
            'image_url' => 'Image Url',
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
