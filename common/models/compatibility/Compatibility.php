<?php

namespace common\models\compatibility;

use Yii;

/**
 * This is the model class for table "product_compatibilities".
 *
 * @property int $id
 * @property string $compatible_device_family
 * @property string $compatible_device_model
 * @property string $relationship
 * @property string $product_skubase
 * @property string $product_reference_name
 * @property string $comments
 */
class Compatibility extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_compatibilities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['compatible_device_family', 'compatible_device_model', 'relationship', 'product_skubase', 'product_reference_name', 'comments'], 'required'],
            [['relationship', 'comments'], 'string'],
            [['compatible_device_family', 'compatible_device_model'], 'string', 'max' => 100],
            [['product_skubase'], 'string', 'max' => 16],
            [['product_reference_name'], 'string', 'max' => 255],
            [['compatible_device_model', 'product_skubase'], 'unique', 'targetAttribute' => ['compatible_device_model', 'product_skubase']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'compatible_device_family' => 'Compatible Device Family',
            'compatible_device_model' => 'Compatible Device Model',
            'relationship' => 'Relationship',
            'product_skubase' => 'Product Skubase',
            'product_reference_name' => 'Product Reference Name',
            'comments' => 'Comments',
        ];
    }

    /**
     * @inheritdoc
     * @return CompatibilityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompatibilityQuery(get_called_class());
    }
}
