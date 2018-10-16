<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Director]].
 *
 * @see Director
 */
class DirectorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Director[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Director|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
