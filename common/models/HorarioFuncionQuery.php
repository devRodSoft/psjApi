<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HorarioFuncion]].
 *
 * @see HorarioFuncion
 */
class HorarioFuncionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
    return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return HorarioFuncion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return HorarioFuncion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function ordered()
    {
        return $this->orderBy(['fecha' => 'DESC', 'hora' => 'ASC']);
    }
}
