<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[RolePermiso]].
 *
 * @see RolePermiso
 */
class RolePermisoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RolePermiso[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RolePermiso|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
