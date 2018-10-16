<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Actor]].
 *
 * @see Actor
 */
class ActorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Actor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Actor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
