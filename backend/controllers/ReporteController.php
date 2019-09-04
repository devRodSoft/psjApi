<?php

namespace backend\controllers;

use Yii;
use common\models\Reporte;
use backend\models\ReporteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReporteController implements the CRUD actions for Reporte model.
 */
class ReporteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * Lists all Reporte models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', []);
    }
}
