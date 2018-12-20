<?php
namespace api\modules\controllers;

use api\controllers\BaseController;

class UserController extends BaseController
{
    public $modelClass = 'common\models\FaceUser';

    public function actions()
    {
        return [
            'view' => [
                'class' => 'yii\rest\ViewAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        // check if the user can access $action and $model
        // throw ForbiddenHttpException if access should be denied

        if ($action === 'update' || $action === 'delete') {
            if ($model->id !== \Yii::$app->user->id) {
                throw new \yii\web\ForbiddenHttpException(sprintf('Esta información es privada.', $action));
            }
        }
    }
}
