<?php

namespace backend\controllers;

use Yii;
use yii\db\Query;
use yii\helpers\Url;
use common\models\Precio;
use common\models\Pelicula;
use common\models\HorarioPrecio;
use backend\controllers\BaseCtrl;
use common\models\HorarioFuncion;
use yii\web\NotFoundHttpException;
use backend\models\HorarioFuncionSearch;

/**
 * FuncionController implements the CRUD actions for Funcion model.
 */
class FuncionController extends BaseCtrl
{

    private $horas = [
        '01' => [1 => '01:00', 2 => '01:05', 3 => '01:10', 4 => '01:15', 5 => '01:20', 6 => '01:25', 7 => '01:30', 8 => '01:35', 9 => '01:40', 10 => '01:45', 11 => '01:50', 12 => '01:55', 13 => '01:60'],
        '02' => [14 => '02:00', 15 => '02:05', 16 => '02:10', 17 => '02:15', 18 => '02:20', 19 => '02:25', 20 => '02:30', 21 => '02:35', 22 => '02:40', 23 => '02:45', 24 => '02:50', 25 => '02:55', 26 => '02:60'],
        '03' => [27 => '03:00', 28 => '03:05', 29 => '03:10', 30 => '03:15', 31 => '03:20', 32 => '03:25', 33 => '03:30', 34 => '03:35', 35 => '03:40', 36 => '03:45', 37 => '03:50', 38 => '03:55', 39 => '03:60'],
        '04' => [40 => '04:00', 41 => '04:05', 42 => '04:10', 43 => '04:15', 44 => '04:20', 45 => '04:25', 46 => '04:30', 47 => '04:35', 48 => '04:40', 49 => '04:45', 50 => '04:50', 51 => '04:55', 52 => '04:60'],
        '05' => [53 => '05:00', 54 => '05:05', 55 => '05:10', 56 => '05:15', 57 => '05:20', 58 => '05:25', 59 => '05:30', 60 => '05:35', 61 => '05:40', 62 => '05:45', 63 => '05:50', 64 => '05:55', 65 => '05:60'],
        '06' => [66 => '06:00', 67 => '06:05', 68 => '06:10', 69 => '06:15', 70 => '06:20', 71 => '06:25', 72 => '06:30', 73 => '06:35', 74 => '06:40', 75 => '06:45', 76 => '06:50', 77 => '06:55', 78 => '06:60'],
        '07' => [79 => '07:00', 80 => '07:05', 81 => '07:10', 82 => '07:15', 83 => '07:20', 84 => '07:25', 85 => '07:30', 86 => '07:35', 87 => '07:40', 88 => '07:45', 89 => '07:50', 90 => '07:55', 91 => '07:60'],
        '08' => [92 => '08:00', 93 => '08:05', 94 => '08:10', 95 => '08:15', 96 => '08:20', 97 => '08:25', 98 => '08:30', 99 => '08:35', 100 => '08:40', 101 => '08:45', 102 => '08:50', 103 => '08:55', 104 => '08:60'],
        '09' => [105 => '09:00', 106 => '09:05', 107 => '09:10', 108 => '09:15', 109 => '09:20', 110 => '09:25', 111 => '09:30', 112 => '09:35', 113 => '09:40', 114 => '09:45', 115 => '09:50', 116 => '09:55', 117 => '09:60'],
        '10' => [118 => '10:00', 119 => '10:05', 120 => '10:10', 121 => '10:15', 122 => '10:20', 123 => '10:25', 124 => '10:30', 125 => '10:35', 126 => '10:40', 127 => '10:45', 128 => '10:50', 129 => '10:55', 130 => '10:60'],
        '11' => [131 => '11:00', 132 => '11:05', 133 => '11:10', 134 => '11:15', 135 => '11:20', 136 => '11:25', 137 => '11:30', 138 => '11:35', 139 => '11:40', 140 => '11:45', 141 => '11:50', 142 => '11:55', 143 => '11:60'],
        '12' => [144 => '12:00', 145 => '12:05', 146 => '12:10', 147 => '12:15', 148 => '12:20', 149 => '12:25', 150 => '12:30', 151 => '12:35', 152 => '12:40', 153 => '12:45', 154 => '12:50', 155 => '12:55', 156 => '12:60'],
        '13' => [157 => '13:00', 158 => '13:05', 159 => '13:10', 160 => '13:15', 161 => '13:20', 162 => '13:25', 163 => '13:30', 164 => '13:35', 165 => '13:40', 166 => '13:45', 167 => '13:50', 168 => '13:55', 169 => '13:60'],
        '14' => [170 => '14:00', 171 => '14:05', 172 => '14:10', 173 => '14:15', 174 => '14:20', 175 => '14:25', 176 => '14:30', 177 => '14:35', 178 => '14:40', 179 => '14:45', 180 => '14:50', 181 => '14:55', 182 => '14:60'],
        '15' => [183 => '15:00', 184 => '15:05', 185 => '15:10', 186 => '15:15', 187 => '15:20', 188 => '15:25', 189 => '15:30', 190 => '15:35', 191 => '15:40', 192 => '15:45', 193 => '15:50', 194 => '15:55', 195 => '15:60'],
        '16' => [196 => '16:00', 197 => '16:05', 198 => '16:10', 199 => '16:15', 200 => '16:20', 201 => '16:25', 202 => '16:30', 203 => '16:35', 204 => '16:40', 205 => '16:45', 206 => '16:50', 207 => '16:55', 208 => '16:60'],
        '17' => [209 => '17:00', 210 => '17:05', 211 => '17:10', 212 => '17:15', 213 => '17:20', 214 => '17:25', 215 => '17:30', 216 => '17:35', 217 => '17:40', 218 => '17:45', 219 => '17:50', 220 => '17:55', 221 => '17:60'],
        '18' => [222 => '18:00', 223 => '18:05', 224 => '18:10', 225 => '18:15', 226 => '18:20', 227 => '18:25', 228 => '18:30', 229 => '18:35', 230 => '18:40', 231 => '18:45', 232 => '18:50', 233 => '18:55', 234 => '18:60'],
        '19' => [235 => '19:00', 236 => '19:05', 237 => '19:10', 238 => '19:15', 239 => '19:20', 240 => '19:25', 241 => '19:30', 242 => '19:35', 243 => '19:40', 244 => '19:45', 245 => '19:50', 246 => '19:55', 247 => '19:60'],
        '20' => [248 => '20:00', 249 => '20:05', 250 => '20:10', 251 => '20:15', 252 => '20:20', 253 => '20:25', 254 => '20:30', 255 => '20:35', 256 => '20:40', 257 => '20:45', 258 => '20:50', 259 => '20:55', 260 => '20:60'],
        '21' => [261 => '21:00', 262 => '21:05', 263 => '21:10', 264 => '21:15', 265 => '21:20', 266 => '21:25', 267 => '21:30', 268 => '21:35', 269 => '21:40', 270 => '21:45', 271 => '21:50', 272 => '21:55', 273 => '21:60'],
        '22' => [274 => '22:00', 275 => '22:05', 276 => '22:10', 277 => '22:15', 278 => '22:20', 279 => '22:25', 280 => '22:30', 281 => '22:35', 282 => '22:40', 283 => '22:45', 284 => '22:50', 285 => '22:55', 286 => '22:60'],
        '23' => [287 => '23:00', 288 => '23:05', 289 => '23:10', 290 => '23:15', 291 => '23:20', 292 => '23:25', 293 => '23:30', 294 => '23:35', 295 => '23:40', 296 => '23:45', 297 => '23:50', 298 => '23:55', 299 => '23:60']
    ];
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

        $query->select('max(fecha) AS max, min(fecha) AS min')
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

        // die();
        if ($model->load(Yii::$app->request->post()) && $model->fecha != '') {
            $data = Yii::$app->request->getBodyParam('HorarioFuncion', []);
            $precios = Yii::$app->request->getBodyParam('horarioPrecio', []);
            if (empty($data['hora'])) {
                Yii::$app->session->setFlash('error', "es necesario ingresar al menos una hora");
            }
            if (empty($precios)) {
                Yii::$app->session->setFlash('error', "es necesario ingresar al menos un precio");
            }

            foreach (explode(',', $model->fecha) as $fecha) {
                foreach ($data['hora'] as $horario) {

                    $model = new HorarioFuncion();
                    $model->load(Yii::$app->request->post());
                    $model->fecha = $fecha;
                    if (ceil($horario / 13) < 10) {
                        $model->hora = $this->horas['0' . ceil($horario / 13)][$horario];
                    } else {
                        $model->hora = $this->horas[ceil($horario / 13)][$horario];
                    }

                    if ($model->save()) {
                        foreach ($precios as $precio) {
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
                    } else {
                        Yii::$app->session->setFlash('error', "Tienes un error con los datos u horarios que ingresaste");
                    }
                }
            }
            if (empty($model->errors)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render(
            'create',
            [
                'model' => $model,
                'preciosList' => array_column(Precio::Find()->All(), 'nombre', 'id'),
                'horas' => $this->horas,
            ]
        );
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
