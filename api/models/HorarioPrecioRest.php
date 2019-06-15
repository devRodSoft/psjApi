<?php

namespace api\models;

use common\models\Precio;
use Yii;

/**
 * This is the model class for table "horario_precio".
 *
 * @property int $horario_id
 * @property int $precio_id
 * @property int $usar_especial
 *
 * @property HorarioFuncion $horario
 * @property Precio $precio
 */
class HorarioPrecioRest extends \common\models\HorarioPrecio
{
    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'nombre' => function ($m) {
                return $m->precio->nombre;
            },
            'codigo' => function ($m) {
                return $m->precio->codigo;
            },
            'default' => function ($m) {
                return $m->precio->default;
            },
            'especial' => function ($m) {
                return $m->precio->especial;
            },
            'usar_especial' => function ($m) {
                return !!$m->usar_especial;
            },
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorario()
    {
        return $this->hasOne(HorarioFuncionRest::className(), ['id' => 'horario_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrecio()
    {
        return $this->hasOne(Precio::className(), ['id' => 'precio_id']);
    }
}
