<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_skubases".
 *
 * @property int $id
 * @property string $sku_base
 * @property string $title
 * @property string $description
 * @property string $display_title correct, uniformly spelled version of the product title
 * @property string $specs save product index descriptions
 * @property string $product_url
 * @property string $buy_url
 * @property string $category 'cases','accessories','carriers' -- incudes all bags,sleeves,slings,'covers' - all keyboard products,'other'
 * @property string $type
 * @property int $display_weight increase to move the product to the top
 * @property string $price
 * @property string $released 1st day of the quater
 * @property string $discontinued use now() to flag as discontinued
 */
class Product extends \yii\db\ActiveRecord
{

    public $num_options;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_skubases';
    }

    public static function viewName() {
        return 'product-line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sku_base', 'title', 'description', 'display_title', 'specs', 'product_url', 'buy_url', 'category', 'type', 'price'], 'required'],
            [['specs', 'category', 'type'], 'string'],
            [['display_weight'], 'integer'],
            [['released', 'discontinued'], 'safe'],
            [['sku_base'], 'string', 'max' => 16],
            [['title', 'display_title'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 128],
            [['product_url', 'buy_url'], 'string', 'max' => 255],
            [['price'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sku_base' => 'Sku Base',
            'title' => 'Title',
            'description' => 'Description',
            'display_title' => 'Display Title',
            'specs' => 'Specs',
            'product_url' => 'Product Url',
            'buy_url' => 'Buy Url',
            'category' => 'Category',
            'type' => 'Type',
            'display_weight' => 'Display Weight',
            'price' => 'Price',
            'released' => 'Released',
            'discontinued' => 'Discontinued',
            'num_options' => 'Options',
        ];
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return (new ProductQuery(get_called_class()))->active();
        //return new ProductLineQuery(get_called_class());
    }

    public function getOptions()
    {
        return $this->hasMany(Option::className(), ['sku_base' => 'sku_base']);
    }

    public function getCompatibility()
    {
        return $this->hasMany(Compatibility::className(), ['product_skubase' => 'sku_base']);
    }


}
