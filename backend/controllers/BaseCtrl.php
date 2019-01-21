<?php

namespace backend\controllers;

use common\models\Cine;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BaseCtrl implements the CRUD actions for Asiento model.
 */
class BaseCtrl extends Controller
{
    public function getCine($id == null)
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
}
