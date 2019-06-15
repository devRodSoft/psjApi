<?php
namespace api\controllers;

use common\models\FaceUser;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use Yii;

// 'id' => '5678',
// 'email' => 'sdfg@hotmail.com',
// 'first_name' => 'guy',
// 'last_name' => 'pizcully',

class AuthenticationController extends BaseController
{
    public $modelClass = 'filsh\yii2\oauth2server\models\OauthAccessTokens';

    protected $authenticatorExceptions = ['options', 'revoke', 'token'];

    public function actionRevoke()
    {
        /** @var $response \OAuth2\Response */
        $response = Yii::$app->getModule('oauth2')->getServer()->handleRevokeRequest();
        return $response->getParameters();
    }

    public function actionToken()
    {
        $username = Yii::$app->request->getBodyParam('username', false);

        if ($username != false && !FaceUser::findByUsername($username)) {
            $userInfo = Yii::$app->request->getBodyParam('userInfo', []);

            $user = new FaceUser();
            $user->loadFormArray($userInfo);
            if (!$user->save()) {
                Yii::error($user->errors, 'validations');
                throw new \yii\web\UnauthorizedHttpException('Favor de ingresar los datos de forma correcta');
            }
        }

        /** @var $response \OAuth2\Response */
        $response = Yii::$app->getModule('oauth2')->getServer()->handleTokenRequest();
        return $response->getParameters();
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['exceptionFilter'] = [
            'class' => ErrorToExceptionFilter::className(),
        ];

        return $behaviors;
    }
}
