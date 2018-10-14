<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Funcion]].
 *
 * @see Funcion
 */
class FuncionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Funcion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Funcion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
