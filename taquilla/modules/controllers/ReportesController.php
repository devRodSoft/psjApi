<?php

namespace taquilla\modules\controllers;

use taquilla\controllers\BaseAuthController;
use taquilla\models\ReporteSearchJSON;
use Yii;

class ReportesController extends BaseAuthController
{
    public $modelClass = 'taquilla\models\ReporteSearchJSON';

    private $_paymentTypes = ['taquilla'];

    public function actions()
    {
        return [
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    public function actionVentasDia()
    {
        $searchModel = new ReporteSearchJSON();
        // $searchModel  = new ReporteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $data         = [];

        foreach ($dataProvider->getModels() as $funcion) {

            if (!isset($data[$funcion->nombre_pelicula])) {
                $data[$funcion->nombre_pelicula] = ['funciones' => [], 'total' => 0, 'entradas' => 0];
            }
            if ($funcion->boleto_id != null) {
                $data[$funcion->nombre_pelicula]['funciones'][] = $funcion;
            }

            $data[$funcion->nombre_pelicula]['total'] += $funcion->total;
            $data[$funcion->nombre_pelicula]['entradas'] += $funcion->conteo;
        }

        return $data;

    }

}
