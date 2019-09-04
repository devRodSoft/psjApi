<?php
namespace taquilla\controllers;

use common\models\Permiso;
use common\models\User;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use filsh\yii2\oauth2server\models\OauthAccessTokens;
use Yii;
use yii\rbac\Permission;
use yii\web\HttpException;

// 'id' => '5678',
// 'email' => 'sdfg@hotmail.com',
// 'first_name' => 'guy',
// 'last_name' => 'pizcully',

class AuthenticationController extends BaseController
{
    public $modelClass = 'filsh\yii2\oauth2server\models\OauthAccessTokens';

    protected $authenticatorExceptions = ['options', 'revoke', 'token'];

    public function actions()
    {
        return [];
    }

    public function actionOptions()
    {
        if (Yii::$app->getRequest()->getMethod() !== 'OPTIONS') {
            Yii::$app->getResponse()->setStatusCode(405);
        }

        Yii::$app->getResponse()->getHeaders()->set('Allow', implode(', ', ['POST', 'HEAD', 'OPTIONS']));
    }

    public function actionRevoke()
    {
        if (Yii::$app->user->logout()) {
            $server  = Yii::$app->getModule('oauth2')->getServer();
            $request = Yii::$app->getModule('oauth2')->getRequest();
            $token   = $server->getAccessTokenData($request);

            $tokenObj = OauthAccessTokens::find()->where(['access_token' => $token['access_token']])->one();

            if ($token['expires'] > time() && $tokenObj != null) {
                $tokenObj->expires = new \yii\db\Expression('NOW()');
                $tokenObj->save();
            }

            return ['revoked' => true];
        } else {
            Yii::$app->getResponse()->setStatusCode(500);
            return ['revoked' => false];
        }
    }

    public function actionToken()
    {
        $data = Yii::$app->request->getBodyParams();

        //get user by email
        $user = User::findByUsername($data['username']);

        if (!$user) {
            throw new HttpException(401, "Invalid email and password combination");
        }

        if ($user->hasPermission(Permiso::ACCESS_TAQUILLA)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }

        $server       = Yii::$app->getModule('oauth2')->getServer();
        $request      = Yii::$app->getModule('oauth2')->getRequest();
        $response     = $server->handleTokenRequest($request);
        $token        = $response->getParameters();
        $token["sub"] = $user->id;
        return $token;
    }

    // public function actionAuthorize()
    // {
    //     $server   = Yii::$app->getModule('oauth2')->getServer();
    //     $request  = Yii::$app->getModule('oauth2')->getRequest();
    //     $response = new \OAuth2\Response();

    //     // validate the authorize request
    //     if (!$server->validateAuthorizeRequest($request, $response)) {
    //         $response->send();
    //         Yii::$app->end();
    //     }

    //     if (Yii::$app->request->isPost) {
    //         // print the authorization code if the user has authorized your client
    //         $is_authorized = (Yii::$app->request->post('authorized') === 'yes');
    //         $server->handleAuthorizeRequest($request, $response, $is_authorized, Yii::$app->user->identity->id);

    //         $response->send();
    //         Yii::$app->end();
    //     }

    //     // Get client
    //     $client = OauthClients::findOne(
    //         [
    //             'client_id' => Yii::$app->request->get('client_id'),
    //         ]
    //     );
    //     return $this->render('authorize', ['client' => $client]);
    // }
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
