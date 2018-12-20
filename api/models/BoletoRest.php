<?php

namespace api\models;

/**
 * This is the model class for table "boleto".
 *
 * @property int $id
 * @property int $face_user_id
 * @property int $horario_funcion_id
 * @property int $sala_asientos_id
 * @property int $reclamado
 * @property string $created_at
 * @property string $updated_at
 *
 * @property FaceUser $faceUser
 * @property HorarioFuncion $horarioFuncion
 * @property SalaAsientos $salaAsientos
 */
class BoletoRest extends \common\models\Boleto
{
    public function fields()
    {
        return [
            'id',
            'usuario' => function ($m) {
                return $m->faceUser->nombre;
            },
            'hora' => function ($m) {
                return $m->horarioFuncion->fHora;
            },
            'fecha' => function ($m) {
                return $m->horarioFuncion->fecha;
            },
            'asiento' => function ($m) {
                return $m->salaAsientos->asiento->nombre;
            },
            'sala' => function ($m) {
                return $m->salaAsientos->sala->nombre;
            },
            'reclamado',
        ];
    }
}
