<?php
namespace api\controllers;

use yii\web\Controller;

class PublicController extends Controller
{
    public function actions()
    {
        return ['index'];
    }

    public function actionIndex()
    {
        return "Bienvenido a Cine 1.0";
    }
}
