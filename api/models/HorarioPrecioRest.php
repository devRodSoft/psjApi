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
            'id' => function ($m) {
                return $m->precio->id;
            },
            'nombre' => function ($m) {
                return $m->precio->nombre;
            },
            'codigo' => function ($m) {
                return $m->precio->codigo;
            },
            'precio' => function ($m) {
                if (!$m->usar_especial) {
                    return $m->precio->default;
                }
                return $m->precio->especial;
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
