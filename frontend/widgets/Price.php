<?php
namespace frontend\widgets;


class Price
{
    public static function format( $numericValue, $roundDown = false )
    {
        // hack to round down marketing-friendly prices
        // (no truncating func in php)
        $formattedPrice = $roundDown? (floor($numericValue * 100)) / 100 : $numericValue;
        return money_format('%#2n', $formattedPrice );
    }

}