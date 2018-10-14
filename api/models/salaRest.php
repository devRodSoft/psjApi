<?php

namespace api\models;

/**
 * This is the model class for table "pelicula".
 *
 * @property int $id
 * @property string $nombre
 * @property string $director
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
class SalaRest extends \common\models\Sala
{
    public function fields()
    {
        return [
            'id',
            'cine_id',
            'nombre',
            'asientos',
        ];
    }
}
