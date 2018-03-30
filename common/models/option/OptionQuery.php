<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Option]].
 *
 * @see ProductOption
 */
class OptionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Option[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Option|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active($state = 0)
    {
        return $this
            ->andOnCondition([Option::tableName() . '.discontinued' => $state]);
    }

    public function havingActiveProduct()
    {
        return $this
            ->innerJoinWith('product');
    }

    public function withBaseProductId()
    {
        return $this
            ->innerJoinWith('product')
            ->select([
                Option::tableName() . '.*',
                Product::tableName() . '.id as skubase_id',
            ]);
    }

    public function orderByDisplayWeight()
    {
        return $this
            ->orderBy([Option::tableName() . '.display_weight' => SORT_DESC]);
    }

    public function byProductId($productId)
    {
        return $this
            ->where([Product::tableName() . '.id' => $productId]);
    }

    public function byProductSkubase($skubase)
    {
        return $this
            ->where([Product::tableName() . '.sku_base' => $skubase]);
    }

    public function byId($id)
    {
        return $this
            ->where([Option::tableName() . '.id' => $id]);
    }
}
