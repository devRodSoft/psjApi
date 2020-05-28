<?php
namespace taquilla\controllers;

use common\models\Permiso;
use filsh\yii2\oauth2server\exceptions\HttpException as HttpException;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;

class BaseAuthController extends BaseController
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    ['class' => HttpBearerAuth::className()],
                    ['class' => QueryParamAuth::className(), 'tokenParam' => 'accessToken'],
                ],
            ],
            'exceptionFilter' => [
                'class' => ErrorToExceptionFilter::className(),
            ],
            // 'except' => ['options'],
        ]);
    }

    public function beforeAction($action)
    {
        if ($action->id != 'options' && Yii::$app->user && !Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->hasPermission(Permiso::ACCESS_TAQUILLA)) {
                throw new HttpException(403, "No tienes los permisos necesarios");
            }
        }
        return parent::beforeAction($action);
    }
}
