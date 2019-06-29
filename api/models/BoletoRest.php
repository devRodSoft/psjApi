<?php

namespace api\models;

use common\models\SalaAsientos;

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
            'sala' => function ($m) {
                return $m->horarioFuncion->sala->nombre;
            },
            'asientos' => function ($m) {
                return array_map(function ($arr) {
                    return new SalaAsientos($arr->salaAsientos->attributes);
                },
                    $m->boletoAsientos
                );
            },
            'image_url' => function ($m) {
                $module = \Yii::$app->getModule('oauth2');
                $token  = $module->getServer()->getResourceController()->getToken();
                return \yii\helpers\Url::to(["/user/boletos/$m->id/qr", 'accessToken' => $token['access_token']], true);
            },
            'pelicula' => function ($m) {
                return $m->pelicula->nombre;
            },
            'total',
            'preciosCount',
            'hash',
            'reclamado',
        ];
    }
}
