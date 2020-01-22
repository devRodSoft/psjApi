<?php

namespace backend\controllers;

use common\models\Cine;
use common\models\Permiso;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

/**
 * BaseCtrl implements the CRUD actions for Asiento model.
 */
class BaseCtrl extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function getCine($id = null)
    {
        if ($id == null) {
            $model = Cine::find()->one();
            return $model;
        }

        if (($model = Cine::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function beforeAction($action)
    {
        if (Yii::$app->user && !Yii::$app->user->isGuest) {
            if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_ADMIN)) {
                throw new HttpException(403, "No tienes los permisos necesarios");
            }
        }
        return parent::beforeAction($action);
    }
}
