<?php

namespace backend\controllers;

use backend\controllers\BaseCtrl;
use backend\models\PeliculaSearch;
use common\models\Clasificacion;
use common\models\Distribuidora;
use common\models\Genero;
use common\models\Pelicula;
use common\models\Permiso;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * PeliculaController implements the CRUD actions for Pelicula model.
 */
class PeliculaController extends BaseCtrl
{

    public function beforeAction($action)
    {
        if (Yii::$app->user && !Yii::$app->user->isGuest) {
            if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_PELICULAS)) {
                throw new HttpException(403, "No tienes los permisos necesarios");
            }
        }
        return parent::beforeAction($action);
    }

    /**
     * Lists all Pelicula models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new PeliculaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pelicula model.
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
     * Creates a new Pelicula model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_PELICULAS_CREAR)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }
        $model = new Pelicula();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        $clasificaciones = ArrayHelper::map(Clasificacion::find()->select('id, nombre')->orderBy('orden')->all(), 'nombre', 'nombre');
        $distribuidoras  = ArrayHelper::map(Distribuidora::find()->select('id, nombre')->orderBy('nombre')->all(), 'id', 'nombre');
        $generos         = ArrayHelper::map(Genero::find()->select('id, nombre')->all(), 'nombre', 'nombre');
        return $this->render('create', [
            'model' => $model,
            'clasificaciones' => $clasificaciones,
            'distribuidoras' => $distribuidoras,
            'generos' => $generos,
        ]);
    }

    /**
     * Updates an existing Pelicula model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->identity->hasPermission(Permiso::ACCESS_PELICULAS_CREAR)) {
            throw new HttpException(403, "No tienes los permisos necesarios");
        }
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->imageFile != null) {
                $model->upload();
            }

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $clasificaciones = ArrayHelper::map(Clasificacion::find()->select('id, nombre')->orderBy('orden')->all(), 'nombre', 'nombre');
        $distribuidoras  = ArrayHelper::map(Distribuidora::find()->select('id, nombre')->orderBy('nombre')->all(), 'id', 'nombre');
        $generos         = ArrayHelper::map(Genero::find()->select('nombre, nombre')->all(), 'nombre', 'nombre');
        return $this->render('update', [
            'model' => $model,
            'clasificaciones' => $clasificaciones,
            'distribuidoras' => $distribuidoras,
            'generos' => $generos,
        ]);
    }

    /**
     * Deletes an existing Pelicula model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    /**
     * Finds the Pelicula model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pelicula the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pelicula::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
