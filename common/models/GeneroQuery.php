<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Genero]].
 *
 * @see Genero
 */
class GeneroQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Genero[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Genero|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
