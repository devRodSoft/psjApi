<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BoletoPrecio]].
 *
 * @see BoletoPrecio
 */
class BoletoPrecioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BoletoPrecio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BoletoPrecio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
