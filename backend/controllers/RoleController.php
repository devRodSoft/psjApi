<?php

namespace backend\controllers;

use backend\controllers\BaseCtrl;
use backend\models\RoleSearch;
use common\models\Permiso;
use common\models\Role;
use Yii;
use yii\web\HttpException as HttpException;
use yii\web\NotFoundHttpException;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends BaseCtrl
{
    public function beforeAction($action)
    {
        if (Yii::$app->user && !Yii::$app->user->isGuest) {
            if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_ROLES)) {
                throw new HttpException(403, "No tienes los permisos necesarios");
            }
        }
        return parent::beforeAction($action);
    }

    /**
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Role model.
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
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_ROLES_CREAR)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }
        $model = new Role();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save() && $model->savePermisos($_POST['Role']['permisos'])) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_ROLES_CREAR)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save() && $model->savePermisos($_POST['Role']['permisos'])) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
