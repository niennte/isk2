<?php
namespace backend\widgets;


use yii\helpers\Html;
use yii\helpers\Url;

class Product
{
    const VIEW_NAME = '/product/view';
    const INDEX_NAME = '/product/index';
    const INDEX_SEARCH_NAME = 'ProductSearch';

    public static function viewLink($label, $id) {
        return Html::a($label, Url::to([self::VIEW_NAME, 'id' => $id]));
    }

    public static function indexSearchLink($label, $value, $attr = 'sku_base')
    {
        return Html::a(
            $label,
            Url::to([self::INDEX_NAME, self::INDEX_SEARCH_NAME . '[' . $attr . ']' => $value])
        );
    }
}