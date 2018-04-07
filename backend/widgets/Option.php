<?php
namespace backend\widgets;


use yii\helpers\Html;
use yii\helpers\Url;

class Option
{
    const VIEW_NAME = '/option/view';
    const INDEX_NAME = 'option/index';
    const INDEX_SEARCH_NAME = 'OptionSearch';

    public static function viewLink($label, $id)
    {
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