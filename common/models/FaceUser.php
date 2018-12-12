<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "face_user".
 *
 * @property int $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $cumpleaños
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class FaceUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'face_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'first_name', 'last_name', 'email'], 'required'],
            [['cumpleaños', 'created_at', 'updated_at'], 'safe'],
            [['status'], 'integer'],
            [['username', 'first_name', 'last_name', 'email'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'cumpleaños' => 'Cumpleaños',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return FaceUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FaceUserQuery(get_called_class());
    }
}
