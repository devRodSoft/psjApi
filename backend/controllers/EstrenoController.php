<?php

namespace backend\controllers;

use backend\controllers\BaseCtrl;
use backend\models\EstrenoSearch;
use common\models\Estreno;
use common\models\Permiso;
use Yii;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

/**
 * EstrenoController implements the CRUD actions for Estreno model.
 */
class EstrenoController extends BaseCtrl
{

    public function beforeAction($action)
    {
        if (Yii::$app->user && !Yii::$app->user->isGuest) {
            if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_ESTRENOS)) {
                throw new HttpException(403, "No tienes los permisos necesarios");
            }
        }
        return parent::beforeAction($action);
    }

    /**
     * Lists all Estreno models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new EstrenoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Estreno model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Estreno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_ESTRENOS_CREAR)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }
        $model = new Estreno();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Estreno model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_ESTRENOS_CREAR)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Estreno model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_ESTRENOS_CREAR)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Estreno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Estreno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Estreno::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
