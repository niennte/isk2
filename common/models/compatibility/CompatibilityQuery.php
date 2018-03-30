<?php

namespace common\models\compatibility;

/**
 * This is the ActiveQuery class for [[Compatibility]].
 *
 * @see Compatibility
 */
class CompatibilityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Compatibility[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Compatibility|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    // findForDevice

}
