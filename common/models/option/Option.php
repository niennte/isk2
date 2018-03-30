<?php

namespace common\models\option;

use common\models\product\Product;
use Yii;

/**
 * This is the model class for table "product_options".
 *
 * @property int $id
 * @property string $sku
 * @property string $sku_base
 * @property string $title
 * @property string $description
 * @property string $option
 * @property int $display_weight greater weight displays first
 * @property string $price
 * @property string $stock
 * @property string $discontinued use now() to flag as deleted
 */
class Option extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_options';
    }

    public static function viewName()
    {
        return 'product-option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sku', 'sku_base', 'title', 'description', 'option', 'price', 'stock'], 'required'],
            [['display_weight'], 'integer'],
            [['discontinued'], 'safe'],
            [['sku', 'sku_base'], 'string', 'max' => 16],
            [['title', 'option'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 128],
            [['price', 'stock'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sku' => 'Sku',
            'sku_base' => 'Sku Base',
            'title' => 'Title',
            'description' => 'Description',
            'option' => 'Option',
            'display_weight' => 'Display Weight',
            'price' => 'Price',
            'stock' => 'Stock',
            'discontinued' => 'Discontinued',
        ];
    }

    /**
     * @inheritdoc
     * @return OptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return (new OptionQuery(get_called_class()))->active();
        //return (new OptionQuery(get_called_class()));
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['sku_base' => 'sku_base']);
    }
}
