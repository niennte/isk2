<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Xmas]].
 *
 * @see Xmas
 */
class XmasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Xmas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Xmas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function selectAll()
    {
        return $this
            ->select([
                Xmas::tableName() . '.*',
                Product::tableName() . '.*',
            ]);
    }

    public function withProductLine()
    {
        return $this
            ->joinWith('product')
            ->where([Product::tableName() . '.discontinued' => 0]);
    }

    public function defaultOrder()
    {
        return $this
            ->orderBy([Product::tableName() . '.display_weight' => SORT_DESC]);
    }

    public function forCategory($category)
    {
        return $this
            ->andWhere(['category' => $category]);
    }




}
