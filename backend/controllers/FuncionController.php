<?php

namespace backend\controllers;

use backend\models\FuncionSearch;
use common\models\Funcion;
use common\models\HorarioFuncion;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * FuncionController implements the CRUD actions for Funcion model.
 */
class FuncionController extends Controller
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
     * Lists all Funcion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new FuncionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Funcion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'hrs' => $this->getHrs($model),
        ]);
    }

    /**
     * Creates a new Funcion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Funcion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach (Yii::$app->request->getBodyParam('horario', []) as $horario) {
                if (empty($horario['fecha']) || empty($horario['hora']) || empty($horario['sala'])) {
                    break;
                }
                if (isset($horario['id'])) {
                    $nhr = HorarioFuncion::findOne($horario['id']);
                    if (!empty($nhr)) {
                        $nhr->fecha   = $horario['fecha'];
                        $nhr->hora    = $horario['hora'];
                        $nhr->sala_id = $horario['sala'];
                    }
                } else {
                    $nhr             = new HorarioFuncion();
                    $nhr->funcion_id = $model->id;
                    $nhr->fecha      = $horario['fecha'];
                    $nhr->hora       = $horario['hora'];
                    $nhr->sala_id    = $horario['sala'];
                }

                $nhr->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'hrs' => $this->getHrs(),
        ]);
    }

    /**
     * Updates an existing Funcion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // var_dump($_POST);die();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach (Yii::$app->request->getBodyParam('horario', []) as $horario) {
                if (empty($horario['fecha']) || empty($horario['hora']) || empty($horario['sala'])) {
                    break;
                }
                if (isset($horario['id'])) {
                    $nhr = HorarioFuncion::findOne($horario['id']);
                    if (!empty($nhr)) {
                        $nhr->fecha   = $horario['fecha'];
                        $nhr->hora    = $horario['hora'];
                        $nhr->sala_id = $horario['sala'];
                    }
                } else {
                    $nhr             = new HorarioFuncion();
                    $nhr->funcion_id = $model->id;
                    $nhr->fecha      = $horario['fecha'];
                    $nhr->hora       = $horario['hora'];
                    $nhr->sala_id    = $horario['sala'];
                }

                $nhr->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'hrs' => $this->getHrs($model),
        ]);
    }

    /**
     * Deletes an existing Funcion model.
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
     * Finds the Funcion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Funcion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Funcion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getHrs($model = null)
    {
        if (is_null($model)) {
            return [];
        }
        $hrs = [];
        foreach ($model->horarios as $horario) {
            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $horario->fecha . ' ' . $horario->hora);
            $hrs[]    = [
                'id' => $horario->id,
                'title' => $horario->sala->nombre,
                'start' => $dateTime->format('Y-m-d H:i'),
                // 'end' => $dateTime->add(new \DateInterval('PT' . $horario->pelicula->duracion . 'M'))->format('Y-m-d H:i'),
                'editable' => false,
                'allDay' => false,
            ];
        }

        return $hrs;
    }
}
