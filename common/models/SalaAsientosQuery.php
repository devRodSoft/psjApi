<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[SalaAsientos]].
 *
 * @see SalaAsientos
 */
class SalaAsientosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SalaAsientos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SalaAsientos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
