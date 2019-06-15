<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HorarioPrecio]].
 *
 * @see HorarioPrecio
 */
class HorarioPrecioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return HorarioPrecio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return HorarioPrecio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
