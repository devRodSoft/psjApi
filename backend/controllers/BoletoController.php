<?php

namespace backend\controllers;

use backend\models\BoletoSearch;
use common\models\Boleto;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BoletoController implements the CRUD actions for Boleto model.
 */
class BoletoController extends Controller
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
     * Lists all Boleto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new BoletoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Boleto model.
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
     * Creates a new Boleto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new Boleto();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Updates an existing Boleto model.
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

        $asientos = (new \yii\db\Query())
            ->select(['id' => 'sa.id', 'nombre' => 'CONCAT(a.fila, "-", a.numero)'])
            ->from(['sa' => 'sala_asientos'])
            ->innerJoin(['ha' => 'horario_funcion'], 'ha.sala_id = sa.sala_id')
            ->innerJoin(['b' => 'boleto'], 'b.horario_funcion_id = ha.id')
            ->leftJoin(['b2' => 'boleto'], 'b2.sala_asientos_id = sa.id')
            ->leftJoin(['a' => 'asiento'], 'a.id = sa.asiento_id')
            ->where(['b.id' => $model->id])
            ->andWhere(['in', 'a.tipo', [1, 2]])
            ->andWhere(['or', ['b2.id' => null], ['=', 'b2.id', $model->id]])
            ->all();

        if (!empty($asientos)) {
            $asientos = array_column($asientos, 'nombre', 'id');
        }

        return $this->render('update', [
            'model' => $model,
            'asientos' => $asientos,
        ]);
    }

    /**
     * Deletes an existing Boleto model.
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
     * Finds the Boleto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Boleto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Boleto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
