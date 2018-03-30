<?php

namespace common\models\promo;

/**
 * This is the ActiveQuery class for [[Promo]].
 *
 * @see Promo
 */
class PromoQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return Promo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Promo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
