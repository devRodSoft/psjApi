<?php

namespace backend\controllers;

use backend\models\PeliculaSearch;
use common\models\Clasificacion;
use common\models\Distribuidora;
use common\models\Genero;
use common\models\Pelicula;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PeliculaController implements the CRUD actions for Pelicula model.
 */
class PeliculaController extends Controller
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
        $model = new Pelicula();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $clasificaciones = ArrayHelper::map(Clasificacion::find()->select('id, nombre')->orderBy('orden')->all(), 'nombre', 'nombre');
        $distribuidoras  = ArrayHelper::map(Distribuidora::find()->select('id, nombre')->all(), 'id', 'nombre');
        $generos  = ArrayHelper::map(Genero::find()->select('id, nombre')->all(), 'id', 'nombre');
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $clasificaciones = ArrayHelper::map(Clasificacion::find()->select('id, nombre')->orderBy('orden')->all(), 'nombre', 'nombre');
        $distribuidoras  = ArrayHelper::map(Distribuidora::find()->select('id, nombre')->all(), 'id', 'nombre');
        $generos  = ArrayHelper::map(Genero::find()->select('id, nombre')->all(), 'id', 'nombre');
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
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

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
