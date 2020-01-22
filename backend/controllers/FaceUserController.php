<?php

namespace backend\controllers;

use backend\controllers\BaseCtrl;
use backend\models\FaceUserSearch;
use common\models\FaceUser;
use common\models\Permiso as Permiso;
use Yii;
use yii\web\HttpException as HttpException;
use yii\web\NotFoundHttpException;

/**
 * FaceUserController implements the CRUD actions for FaceUser model.
 */
class FaceUserController extends BaseCtrl
{

    public function beforeAction($action)
    {
        if (Yii::$app->user && !Yii::$app->user->isGuest) {
            if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_USUARIOS)) {
                throw new HttpException(403, "No tienes los permisos necesarios");
            }
        }
        return parent::beforeAction($action);
    }

    /**
     * Lists all FaceUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new FaceUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FaceUser model.
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
     * Creates a new FaceUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_USUARIOS_CREAR)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }
        $model = new FaceUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FaceUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_USUARIOS_CREAR)) {
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
     * Deletes an existing FaceUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_USUARIOS_CREAR)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FaceUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FaceUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FaceUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
