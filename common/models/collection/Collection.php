<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_collections".
 *
 * @property int $id
 * @property string $product_sku
 * @property string $product_skubase
 * @property string $collection_title
 * @property string $comments
 */
class Collection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_collections';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_sku', 'product_skubase', 'collection_title', 'comments'], 'required'],
            [['collection_title', 'comments'], 'string'],
            [['product_sku', 'product_skubase'], 'string', 'max' => 16],
            [['product_sku', 'collection_title'], 'unique', 'targetAttribute' => ['product_sku', 'collection_title']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_sku' => 'Product Sku',
            'product_skubase' => 'Product Skubase',
            'collection_title' => 'Collection Title',
            'comments' => 'Comments',
        ];
    }

    /**
     * @inheritdoc
     * @return CollectionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CollectionQuery(get_called_class());
    }
}
