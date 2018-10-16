<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PeliculaActor]].
 *
 * @see PeliculaActor
 */
class PeliculaActorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PeliculaActor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PeliculaActor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
