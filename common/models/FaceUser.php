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
class FaceUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface, \OAuth2\Storage\UserCredentialsInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE  = 10;

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
            [['username', 'first_name', 'last_name', 'email', 'avatar'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
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
            'nombre' => 'Nombre completo',
            'first_name' => 'Nombre',
            'last_name' => 'Apellido',
            'email' => 'Email',
            'cumpleaños' => 'Cumpleaños',
            'status' => 'Activo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getNombre()
    {
        return sprintf('%s %s', $this->first_name, $this->last_name);
    }

    /**
     * {@inheritdoc}
     * @return FaceUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FaceUserQuery(get_called_class());
    }

    /**
     * Implemented for Oauth2 Interface
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        /** @var \filsh\yii2\oauth2server\Module $module */
        $module = Yii::$app->getModule('oauth2');
        $token  = $module->getServer()->getResourceController()->getToken();
        return !empty($token['user_id'])
        ? static::findIdentity($token['user_id'])
        : null;
    }

    /**
     * Implemented for Oauth2 Interface
     */
    public function checkUserCredentials($username, $password)
    {
        $user = static::findByUsername($username);
        if (empty($user)) {
            return false;
        }
        return $user->validatePassword($password);
    }

    /**
     * Implemented for Oauth2 Interface
     */
    public function getUserDetails($username)
    {
        $user = static::findByUsername($username);
        return ['user_id' => $user->getId()];
    }

    public function validatePassword($tokenToInspect)
    {
        return static::ValidateFacebookToken($tokenToInspect);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public function loadFromArray($userInfo)
    {
        if (isset($userInfo['id'])) {
            $this->username = $userInfo['id'];
        }
        if (isset($userInfo['first_name'])) {
            $this->first_name = $userInfo['first_name'];
        }
        if (isset($userInfo['last_name'])) {
            $this->last_name = $userInfo['last_name'];
        }
        if (isset($userInfo['email'])) {
            $this->email = $userInfo['email'];
        }
    }

    public static function ValidateFacebookToken($tokenToInspect)
    {
        $appTokenOrAdminToken = Yii::$app->params['faceAppToken'];

        // graph.facebook.com/debug_token?input_token={token-to-inspect}&access_token={app-token-or-admin-token}
        $url = sprintf("graph.facebook.com/debug_token?input_token=%s&access_token=%s", $tokenToInspect, $appTokenOrAdminToken);
        //  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
        // Execute
        $result = curl_exec($ch);
        // Closing
        curl_close($ch);

        // var_dump(json_decode($result, true));

        return true;
    }
}
