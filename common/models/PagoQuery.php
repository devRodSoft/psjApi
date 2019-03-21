<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Pago]].
 *
 * @see Pago
 */
class PagoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Pago[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Pago|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
