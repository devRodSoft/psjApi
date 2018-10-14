<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Pelicula]].
 *
 * @see Pelicula
 */
class PeliculaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Pelicula[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Pelicula|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
