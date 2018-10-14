<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Cine]].
 *
 * @see Cine
 */
class CineQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Cine[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Cine|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
