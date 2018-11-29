<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Asiento]].
 *
 * @see Asiento
 */
class AsientoQuery extends \yii\db\ActiveQuery
{
    public function ordered()
    {
        return $this->orderBy(['fila' => 'DESC']);
    }

    /**
     * {@inheritdoc}
     * @return Asiento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Asiento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
