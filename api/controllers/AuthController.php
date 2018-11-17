<?php
namespace api\controllers;

class AuthController extends BaseController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // // remove authentication filter
        // $auth = $behaviors['authenticator'];
        // unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                // restrict access to
                'Access-Control-Allow-Origin' => ['*'],
                'Origin' => [
                    'http://localhost:8100',
                    'http://api.rodsoft.com.mx:80',
                    'https://api.rodsoft.com.mx:443',
                    'https://localhost:8100',
                ],
                // Allow only POST and PUT methods
                // 'Access-Control-Request-Method'    => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Method' => ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'OPTIONS'],
                // Allow only headers 'X-Wsse'
                'Access-Control-Request-Headers' => ['X-Wsse'],
                // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
                'Access-Control-Allow-Credentials' => true,
                // Allow OPTIONS caching
                'Access-Control-Max-Age' => 3600,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            ],
        ];

        // // re-add authentication filter
        // $behaviors['authenticator'] = $auth;
        // // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        // $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }

    public function actions()
    {
        return [
            [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
        ];
    }

    /**
     * @param OAuth2 $client
     */
    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
    }

    // public function actions()
    // {
    //     return [
    //         'social' => [
    //             'class' => 'yii\authclient\AuthAction',
    //             'successCallback' => [$this, 'onAuthSuccess'],
    //         ],
    //     ];
    // }
    // /**
    //  * It is called when the user has been successfully authenticated through an external service.
    //  * @param BaseClient $client
    //  * @return mixed
    //  */
    // public function onAuthSuccess($client)
    // {
    //     $attributes = $client->getUserAttributes();
    //     $id         = (string) ArrayHelper::getValue($attributes, 'id');
    //     /* @var SocialConnection $socialConnection */
    //     $socialConnection = SocialConnection::find()->where([
    //         'source' => $client->getId(),
    //         'sourceId' => $id,
    //     ])->one();
    //     if (Yii::$app->user->isGuest) {
    //         if ($socialConnection && $socialConnection->userId) {
    //             // login
    //             Yii::$app->user->login($socialConnection->user);
    //             return $this->redirect('/');
    //         } else if ($socialConnection) {
    //             //registration
    //             return $this->redirect(['/auth/auth/registration', 'source' => $client->getId(), 'sourceId' => $id]);
    //         } else {
    //             $socialConnection = new SocialConnection([
    //                 'source' => $client->getId(),
    //                 'sourceId' => $id,
    //             ]);
    //             $socialConnection->saveOrPanic();
    //             // registration
    //             return $this->redirect(['/auth/auth/registration', 'source' => $client->getId(), 'sourceId' => $id]);
    //         }
    //     } else {
    //         // user already logged in
    //         if (!$socialConnection) {
    //             // add socialConnection provider
    //             $socialConnection = new SocialConnection([
    //                 'userId' => Yii::$app->user->id,
    //                 'source' => $client->getId(),
    //                 'sourceId' => $id,
    //             ]);
    //             $socialConnection->saveOrPanic();
    //             \Yii::$app->session->setFlash('success', \Yii::t('app', 'Social account success added!'));
    //             return $this->redirect(['/profile/edit']);
    //         }
    //         return $this->redirect('/');
    //     }
    // }
    // public function actionLogin()
    // {
    //     if (!\Yii::$app->user->isGuest) {
    //         return $this->goHome();
    //     }
    //     $model = new LoginForm();
    //     if ($model->load(\Yii::$app->request->post()) && $model->login()) {
    //         return $this->goBack();
    //     }
    //     $model->password = '';
    //     return $this->render('login', [
    //         'model' => $model,
    //     ]);
    // }
    // public function actionRegistration()
    // {
    //     if (!\Yii::$app->user->isGuest) {
    //         return $this->goHome();
    //     }
    //     $model = new RegistrationForm();
    //     if ($model->load(\Yii::$app->request->post()) && $model->register()) {
    //         // Auto login
    //         $loginModel           = new LoginForm();
    //         $loginModel->username = $model->email;
    //         $loginModel->password = $model->password;
    //         $loginModel->login();
    //         $params = Yii::$app->request->queryParams;
    //         if (!empty($params['source']) && !empty($params['sourceId'])) {
    //             $socialParam = [
    //                 'source' => $params['source'],
    //                 'sourceId' => $params['sourceId'],
    //             ];
    //             /** @var SocialConnection $socialConnection */
    //             $socialConnection = SocialConnection::findOne($socialParam)
    //             ?: new SocialConnection($socialParam);
    //             $socialConnection->userId = \Yii::$app->user->id;
    //             $socialConnection->saveOrPanic();
    //         }
    //         return $this->goHome();
    //     }
    //     return $this->render('registration', [
    //         'model' => $model,
    //     ]);
    // }
    // public function actionAgreement()
    // {
    //     return $this->render('agreement');
    // }
    // public function actionLogout()
    // {
    //     \Yii::$app->user->logout();
    //     return $this->goHome();
    // }
}
