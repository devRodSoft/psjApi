<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Precio]].
 *
 * @see Precio
 */
class PrecioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Precio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Precio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
