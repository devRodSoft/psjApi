<?php

namespace backend\controllers;

use backend\models\HorarioFuncionSearch;
use common\models\HorarioFuncion;
use common\models\HorarioPrecio;
use common\models\Pelicula;
use common\models\Precio;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
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
        $searchModel  = new HorarioFuncionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Funcion models.
     * @return mixed
     */
    public function actionPlanner()
    {
        $all   = Yii::$app->request->getQueryParam('all', null);
        $query = HorarioFuncion::find();
        if (is_null($all)) {
            $query->andWhere('fecha >= cast(NOW() AS DATE)');
        }
        $data = $query->all();

        return $this->render('planner', [
            'hrs' => $this->getHrs($data, true),
        ]);
    }

    /**
     * Lists all Funcion models.
     * @return mixed
     */
    public function actionCalendar($id)
    {
        $data = HorarioFuncion::find()->where(['pelicula_id' => $id])->all();
        $peli = Pelicula::find()->where(['id' => $id])->one();

        $query = new Query;

        $query->select('max(fecha) AS min, min(fecha) AS max')
            ->from(HorarioFuncion::tableName())
            ->where(['pelicula_id' => $id])
            ->limit(1);

        $fechas = $query->one();

        return $this->render('calendar', [
            'info' => $peli,
            'fechas' => $fechas,
            'hrs' => $this->getHrs($data),
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
            'hrs' => [],
        ]);
    }

    /**
     * Creates a new Funcion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HorarioFuncion();

        // var_dump($_POST);die();
        if ($model->load(Yii::$app->request->post()) && $model->fecha != '') {
            foreach (explode(',', $model->fecha) as $fecha) {
                $model = new HorarioFuncion();
                $model->load(Yii::$app->request->post());
                $model->fecha = $fecha;
                if ($model->save()) {
                    foreach (Yii::$app->request->getBodyParam('horarioPrecio', []) as $precio) {
                        if (empty($precio['precio']) || !isset($precio['precio']['id'])) {
                            break;
                        }
                        $nhr                = new HorarioPrecio();
                        $nhr->horario_id    = $model->id;
                        $nhr->precio_id     = $precio['precio']['id'];
                        $nhr->usar_especial = intval(isset($precio['precio']['usar_especial']));

                        if (!$nhr->save()) {
                            Yii::$app->session->setFlash('error', "Tienes un error con los precios que ingresaste, \nrecuerda que no debes duplicar precios");
                        }
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'preciosList' => array_column(Precio::Find()->All(), 'nombre', 'id'),
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            HorarioPrecio::deleteAll(['horario_id' => $model->id]);

            foreach (Yii::$app->request->getBodyParam('horarioPrecio', []) as $precio) {
                if (empty($precio['precio']) || !isset($precio['precio']['id'])) {
                    break;
                }
                $nhr                = new HorarioPrecio();
                $nhr->horario_id    = $model->id;
                $nhr->precio_id     = $precio['precio']['id'];
                $nhr->usar_especial = intval(isset($precio['precio']['usar_especial']));

                if (!$nhr->save()) {
                    Yii::$app->session->setFlash('error', "Tienes un error con los precios que ingresaste, \nrecuerda que no debes duplicar precios");
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'preciosList' => array_column(Precio::Find()->All(), 'nombre', 'id'),
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
        if (($model = HorarioFuncion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getHrs($models = null, $movieTitle = false)
    {
        if (is_null($models)) {
            return [];
        }
        $hrs = [];
        foreach ($models as $horario) {
            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $horario->fecha . ' ' . $horario->hora);
            $hrs[]    = [
                'id' => $horario->id,
                'title' => !($movieTitle) ? $horario->sala->nombre : $horario->pelicula->nombre . "\n" . $horario->sala->nombre,
                'start' => $dateTime->format('Y-m-d H:i'),
                'end' => $dateTime->add(new \DateInterval('PT' . $horario->pelicula->duracion . 'M'))->format('Y-m-d H:i'),
                'editable' => false,
                'url' => Url::to(['view', 'id' => $horario->id]),
                'allDay' => false,
            ];
        }

        return $hrs;
    }
}
