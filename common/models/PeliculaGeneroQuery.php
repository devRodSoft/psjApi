<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PeliculaGenero]].
 *
 * @see PeliculaGenero
 */
class PeliculaGeneroQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PeliculaGenero[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PeliculaGenero|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
