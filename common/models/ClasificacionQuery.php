<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Clasificacion]].
 *
 * @see Clasificacion
 */
class ClasificacionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Clasificacion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Clasificacion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
