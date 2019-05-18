<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Distribuidora]].
 *
 * @see Distribuidora
 */
class DistribuidoraQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Distribuidora[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Distribuidora|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
