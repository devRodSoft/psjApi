<?php

namespace api\models;

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
class PeliculaRest extends \common\models\Pelicula
{
    private $_horarios = [];
    public function fields()
    {
        return [
            'id',
            'nombre',
            'distribuidora' => function ($m) {
                return $m->distribuidora->nombre;
            },
            'reparto' => function ($m) {
                return array_column($m->actors, 'nombre');
            },
            'genero',
            'calificacion',
            'clasificacion',
            'idioma',
            'duracion',
            'sinopsis',
            'cartelUrl',
            'trailerUrl',
            'trailerImg',
            'horarios' => function ($m) {
                return $m->_horarios;
            },
        ];
    }

    public function addHorarios($fecha)
    {
        $this->_horarios = HorarioFuncionRest::find()->where(['pelicula_id' => $this->id, 'fecha' => $fecha])->ordered()->all();
    }
}
