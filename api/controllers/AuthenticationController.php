<?php
namespace api\controllers;

class AuthenticationController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            /**
             * checks oauth2 credentions
             * and performs OAuth2 authorization, if user is logged on
             */
            'oauth2Auth' => [
                'class' => \conquer\oauth2\AuthorizeFilter::className(),
                'only' => ['index'],
            ],
        ];
    }

    public function actions()
    {
        return [
            // returns access token
            'token' => [
                'class' => \conquer\oauth2\TokenAction::classname(),
            ],
        ];
    }

/**
 * This function will be triggered when user is successfuly authenticated using some oAuth client.
 *
 * @param yii\authclient\ClientInterface $client
 * @return boolean|yii\web\Response
 */
    public function oAuthSuccess($client)
    {
        // get user data from client
        $userAttributes = $client->getUserAttributes();

        // do some thing with user data. for example with $userAttributes['email']
    }
}
