<?php

namespace taquilla\models;

use backend\models\ReporteSearch;
use Yii;
use yii\base\Model;

/**
 * ReporteSearch represents the model behind the search form of `common\models\Reporte`.
 */
class ReporteSearchJSON extends ReporteSearch
{

    public function formName()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'total' => function ($m) {
                return Yii::$app->formatter->format($m->total, ['decimal', 0]);
            },
            'entradas' => function ($m) {
                return $m->conteo;
            },
            'nombre_distribuidor',
            'boleto_id',
            'nombre_pelicula',
            'idioma',
            'fecha' => function ($m) {
                return Yii::$app->formatter->asDate($m->fecha);
            },
            'hora' => function ($m) {
                return Yii::$app->formatter->asTime($m->hora, 'php:g:i A');
            },
            'sala' => function ($m) {
                if (!empty($m->sala_id)) {
                    return $m->sala->nombre;
                }
                return "";
            },
            'precio',
            'tipo' => function ($m) {
                if (!empty($m->nombre)) {
                    return $m->nombre;
                }
                return "";
            },
        ];
    }
}
