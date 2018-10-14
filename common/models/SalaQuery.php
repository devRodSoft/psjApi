<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Sala]].
 *
 * @see Sala
 */
class SalaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Sala[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Sala|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
