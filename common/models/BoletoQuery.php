<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Boleto]].
 *
 * @see Boleto
 */
class BoletoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Boleto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Boleto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
