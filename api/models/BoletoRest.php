<?php

namespace api\models;

use common\models\SalaAsientos;
use Yii as Yii;
use yii\helpers\Url as Url;

class BoletoRest extends \common\models\Boleto
{
    public function fields()
    {
        return [
            'id',
            'usuario' => function ($m) {
                return $m->faceUser->nombre;
            },
            'vendedor' => function ($m) {
                return  isset($m->user->username) ?  $m->user->username : "";
            },
            'user_id' => function ($m) {
                return  isset($m->user->id) ?  $m->user->id : "";
            },
            'fechaDeVenta' => function ($m) {
                return $m->created_at;
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
                return array_map(
                    function ($boletoAsiento) {
                        $salaAsiento                     = new SalaAsientosRest($boletoAsiento->salaAsientos->attributes);
                        $salaAsiento->id_relacion_boleto = $boletoAsiento->id;
                        return $salaAsiento;
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
            'clasificacion' => function ($m) {
                return $m->pelicula->clasificacion;
            },
            'duracion' => function ($m) {
                return $m->pelicula->duracion;
            },
            'idioma' => function ($m) {
                return $m->pelicula->idioma;
            },
            'total',
            'preciosCount',
            'hash',
            'reclamado',
        ];
    }
}
