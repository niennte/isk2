<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ProductLine]].
 *
 * @see ProductLine
 */
class ProductQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return Product[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Product|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active($state = 0)
    {
        return $this
            ->where([Product::tableName() . '.discontinued' => $state]);
    }

    public function withNumOptions()
    {
        return $this
            ->joinWith('options')
            ->select([
                Product::tableName() . '.*',
                'count(' . Option::tableName() . '.sku) AS num_options',
            ])
            ->groupBy(Product::tableName() . '.sku_base');
    }

    public function byId($id)
    {
        return $this
            ->where([Product::tableName() . '.id' => $id]);
    }

    public function compatibleWith($deviceModel)
    {
        return $this
            ->innerJoinWith('compatibility')
            ->where([Product::tableName() . '.discontinued' => 0])
            ->andWhere(['compatible_device_model' => $deviceModel])
            ->orderBy(['display_weight' => SORT_DESC]);
    }


    public function compatibleWithForCategory($device, $category)
    {
        return $this
            ->select([
                Compatibility::tableName() . '.*',
                Product::tableName() . '.*'
            ])
            ->innerJoinWith('compatibility')
            ->where([Product::tableName() . '.discontinued' => 0])
            ->andWhere(['compatible_device_model' => $device])
            ->andWhere(['category' => $category])
            ->orderBy(['display_weight' => SORT_DESC]);
    }
}
