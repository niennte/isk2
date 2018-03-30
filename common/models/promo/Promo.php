<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_promos".
 *
 * @property int $id
 * @property string $skubase
 * @property double $discount  positive value - percents off, negative value - dollars off
 * @property string $short_description one-liners used in product listings, such as index pages
 * @property string $reference_name convenience look-up, NOT for production
 */
class Promo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_promos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['skubase', 'discount', 'short_description', 'reference_name'], 'required'],
            [['discount'], 'number'],
            [['skubase'], 'string', 'max' => 25],
            [['short_description'], 'string', 'max' => 255],
            [['reference_name'], 'string', 'max' => 100],
            [['skubase'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'skubase' => 'Skubase',
            'discount' => 'Discount',
            'short_description' => 'Short Description',
            'reference_name' => 'Reference Name',
        ];
    }

    /**
     * @inheritdoc
     * @return PromoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PromoQuery(get_called_class());
    }
}
