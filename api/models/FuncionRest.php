<?php

namespace api\models;

use common\models\HorarioFuncion;

/**
 * This is the model class for table "pelicula".
 *
 * @property int $id
 * @property string $nombre
 * @property string $protagonistas
 * @property string $genero
 * @property string $calificacion
 * @property string $clasificacion
 * @property string $idioma
 * @property string $duracion
 * @property string $sinopsis
 * @property string $cartelUrl
 * @property string $trailerUrl
 * @property string $trailerImg
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Funcion[] $funcions
 */
class FuncionRest extends \common\models\Funcion
{
    public $date = null;
    public function fields()
    {
        return [
            'pelicula_id',
            'precio',
            'precio_niños',
            'estreno_inicio',
            'estreno_fin',
            'horarios' => function ($m) {
                return $m->horarios;
            },
            'nombre' => function ($m) {
                return $m->pelicula->nombre;
            },
            'distribuidora' => function ($m) {
                return $m->pelicula->distribuidora->nombre;
            },
            'reparto' => function ($m) {
                return array_column($m->pelicula->reparto, 'nombre');
            },
            'genero' => function ($m) {
                return $m->pelicula->genero;
            },
            'calificacion' => function ($m) {
                return $m->pelicula->calificacion;
            },
            'clasificacion' => function ($m) {
                return $m->pelicula->clasificacion;
            },
            'idioma' => function ($m) {
                return $m->pelicula->idioma;
            },
            'duracion' => function ($m) {
                return $m->pelicula->duracion;
            },
            'sinopsis' => function ($m) {
                return $m->pelicula->sinopsis;
            },
            'cartelUrl' => function ($m) {
                return $m->pelicula->cartelUrl;
            },
            'trailerUrl' => function ($m) {
                return $m->pelicula->trailerUrl;
            },
            'trailerImg' => function ($m) {
                return $m->pelicula->trailerImg;
            },
        ];
    }

    public function getHorarios()
    {
        return $this->hasMany(HorarioFuncion::className(), ['funcion_id' => 'id'])->filterWhere(['horario_funcion.fecha' => $this->date])->ordered();
    }
}
