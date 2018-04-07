<?php

namespace backend\widgets;


use yii\helpers\Html;
use yii\helpers\Url;

abstract class LinkedEntity
{
    public static $viewName;
    public static $indexName;
    public static $indexSearchName;


    /**
     * @param $label
     * @param $id
     * @return mixed
     */
    public static function viewLink($label, $id)
    {
        return Html::a($label, Url::to([static::$viewName, 'id' => $id]));
    }

    /**
     * @param $label
     * @param $value
     * @param string $attr
     * @return string
     */
    public static function indexSearchLink($label, $value, $attr = 'sku_base')
    {
        return Html::a(
            $label,
            Url::to([static::$indexName, static::$indexSearchName . '[' . $attr . ']' => $value])
        );
    }

}
