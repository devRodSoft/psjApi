<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Apartado]].
 *
 * @see Apartado
 */
class ApartadoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Apartado[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Apartado|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
