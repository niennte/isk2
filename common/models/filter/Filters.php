<?php

namespace common\models\filter;

use common\models\product\Product;
use common\models\option\Option;
use common\models\compatibility\Compatibility;
use common\models\collection\Collection;
use common\models\xmas\Xmas;
use common\widgets\Image;

/**
 * Class Filters implements business logic
 * @package app\modules\mobile\models
 */
class Filters
{
    const BASE_IMG_PATH = "https://s3.amazonaws.com/quod.erat.demonstrandum/isk2/content/";
    const PRODUCT_IMG_PATH =  "/build/images/";

    const productFilter = array (

        'iPad' => array(
            'iPad mini' => 'iPadMini',
            'iPad with Retina display (4th gen)' => 'iPadRetina4thGen',
            'new iPad (3rd gen)' => 'iPad3rdGen',
            'iPad 2' => 'iPad2'),
        'iPhone' => array (
            'iPhone 5/5S' => 'iPhone55S',
            'iPhone 5C' => 'iPhone5C',
            'iPhone 5' => 'iPhone5',
            'iPhone 4/4S' => 'iPhone44S'),
        'Samsung' => array (
            'Samsung GS3' => 'SamsungGS3',
            'Samsung GS4' => 'SamsungGS4' ),
        'BlackBerry' => array (
            'Z10' => 'Z10',
            'Bold 9900/9930' => 'bold99009930',
            'Bold 9700/9780' => 'Bold97009780',
            'Bold 9000' => 'Bold9000',
            'Curve 9350/9360' => 'Curve93509360',
            'Curve 8900' => 'Curve8900',
            'Curve 8520/8530' => 'Curve85208530',
            'Torch 9850/9860' => 'torch98509860'),

        'iPod' => array(
            'iPod touch 4G' => 'iPodTouch4G',
            'iPod Classic - 6th Gen (2009)' => 'iPodClassic5thGen2009',
            'iPod Classic - 6th Gen (2007)' => 'iPodClassic5thGen2007',
            'iPod Classic - 5th Gen (2005)' => 'iPodClassic5thGen2005',
        ),

        'Laptops' => array (

            'MacBook Pro 15" 2012' => 'MacBookPro15_2012',
            'MacBook Pro 13" 2012' => 'MacBookPro13_2012',
            'MacBook Pro 15" 2009-2011' => 'MacBookPro15_2009-2011',
            'MacBook Pro 13" 2009-2011' => 'MacBookPro13_2009-2011',
            'MacBook Air 13" 2011-2013' => 'MacBookAir13_2011-2013',
            'MacBook Air 13" 2010' => 'MacBookAir13_2010',
            'MacBook Air 11" 2012' => 'MacBookAir11_2012',
            'MacBook Air 11" 2011' => 'MacBookAir11_2011',
            'MacBook Air 11" 2010' => 'MacBookAir11_2010',
            'MacBook 13" 2011' => 'MacBook13_2011',
            'MacBook 13" 2010' => 'MacBook13_2010',
            'MacBook - Europe/Latin/ME Keyboard layout' => 'MacBookELEKeyboardLayout',
            'MacBook 13"/15" 2010-2011 - Spanish Keyboard layout' => 'MacBookSpanishKeyboard',
            'MacBook Pro 13"/15" 2009-2011 - Spanish Keyboard layout' => 'MacBookProSpanishKeyboard',
            'Apple Keyboards (compact)' => 'AppleKeyboards',
            '13" or smaller laptop' => '13laptop',
            '15" or smaller laptop' => '15laptop'
        ),

    );


    // filter for smart phones
    const smartPhones = array(
        'iPhone' => array (
            'iPhone 5/5S' => 'iPhone55S',
            'iPhone 5C' => 'iPhone5C',
            'iPhone 5' => 'iPhone5',
            'iPhone 4/4S' => 'iPhone44S'),
        'Samsung' => array (
            'Samsung GS4' => 'SamsungGS4',
            'Samsung GS3' => 'SamsungGS3',
        ),
        'BlackBerry' => array (
            'Z10' => 'Z10',
            'Bold 9000' => 'Bold9000',
            'Curve 8900' => 'Curve8900',
            'Torch 9850/9860' => 'torch98509860',
            'Curve 8520/8530' => 'Curve85208530',
            'Bold 9900/9930' => 'bold99009930',
            'Curve 9350/9360/9370' =>'Curve935093609370',
            'Bold 9700/9780' => 'Bold97009780',
            'Curve 9350/9360' => 'Curve93509360'),
    );

    // filter for laptops
    const macBooks = array(
		'MacBook Pro' => array (
			'MacBook Pro 15" 2012' => 'MacBookPro15_2012',
			'MacBook Pro 13" 2012' => 'MacBookPro13_2012',
			'MacBook Pro 15" 2009-2011' => 'MacBookPro15_2009-2011',
			'MacBook Pro 13" 2009-2011' => 'MacBookPro13_2009-2011'
						),
		'MacBook Air' => array (
			'MacBook Air 13" 2011-2013' => 'MacBookAir13_2011-2013',
			'MacBook Air 13" 2010' => 'MacBookAir13_2010',
			'MacBook Air 11" 2010' => 'MacBookAir11_2010'
						),
		'MacBook' => array (
			'MacBook 13" 2011' => 'MacBook13_2011',
			'MacBook 13" 2010' => 'MacBook13_2010'
						),

		'MacBook/Pro Int\'l Keyboards' => array (
			'MacBook - Europe/Latin/ME Keyboard layout' => 'MacBookELEKeyboardLayout',
			'MacBook 13"/15" 2010-2011 - Spanish Keyboard layout' => 'MacBookSpanishKeyboard',
			'MacBook Pro 13"/15" 2009-2011 - Spanish Keyboard layout' => 'MacBookProSpanishKeyboard',
						)
    );


    const laptopItems = array(
        'Apple keyboards (compact)' => 'AppleKeyboards',
        '13" or smaller laptop' => '13laptop',
        '15" or smaller laptop' => '15laptop',
    );


    // filter for collections & specials
    const specials = array(
        'Q.West' => 'qwest',
        'Ducati' => 'ducati',
        'Silo' => 'silo',
        'SOHO' => 'soho',
        'Gravity' => 'gravity'
    );

    const specialItems = array(
        '13" or smaller laptop' => '13laptop',
        '15" or smaller laptop' => '15laptop',
        'iPad or similarly sized tablet' => 'ipad',
        'iPhone 4/4S, iPod Touch or similar' => 'ipod'
    );


    const categories = array(
        'cases',
        'covers',
        'carriers',
        'accessories',
    );

    public static function fetchDeviceFamily($device)
    {
        $contentDir = false;
        foreach( self::productFilter as $deviceFamily => $devices ) {
            // find if either full name or shortcode is provided
            if ( in_array( $device, array_values($devices) ) || in_array( $device, array_keys($devices) ) ) {
                $deviceCode = $device;

                foreach( $devices as $device => $code ) {
                    if ( $code == $deviceCode || $device == $deviceCode ) {
                        $queryDevice = $device;
                        $contentDir = $deviceFamily;
                        break;
                    }
                }
            }
        }
        return $contentDir;
    }

    public static function fetchDevice($device)
    {
        $queryDevice = false;

        foreach( self::productFilter as $deviceFamily => $devices ) {
            // find if either full name or shortcode is provided
            if ( in_array( $device, array_values($devices) ) || in_array( $device, array_keys($devices) ) ) {
                $deviceCode = $device;

                foreach( $devices as $device => $code ) {

                    if ( $code == $deviceCode || $device == $deviceCode ) {
                        $queryDevice = $device;
                        $contentDir = $deviceFamily;
                        break;
                    }
                }
            }
        }

        return $queryDevice;
    }

    public static function fetchProductsFor($device)
    {

        $allFoundProducts = array();
        $queryDevice = self::fetchDevice($device);

        foreach(self::categories as $category) {

            if (is_array(
                $foundProductsForCategory = Product::find()
                ->compatibleWithForCategory($queryDevice, $category)
                ->asArray()
                ->all())) {

                $allFoundProducts = array_merge(
                    $allFoundProducts,
                    $foundProductsForCategory
                );
            }
        }

        return self::fixFoundProducts($allFoundProducts, $device);
    }

    public static function fetchProductWithOptions($productId, $deviceFamily = false)
    {
        return self::fixGlitches(
            Option::find()
                ->orderByDisplayWeight()
                ->havingActiveProduct()
                ->byProductId($productId)
                ->asArray()
                ->all()
        );
    }

    public static function fetchProductWithOptionsBySkubase($skubase, $clearDisplayProduct = false)
    {
        return self::fixGlitches(
            Option::find()
                ->orderByDisplayWeight()
                ->havingActiveProduct()
                ->byProductSkubase($skubase)
                ->asArray()
                ->all(),
            $clearDisplayProduct
        );
    }

    public static function fetchIndexFor($device)
    {
        $device = self::fetchDevice($device);
        return self::fixFoundProducts(
            self::fetchProductsFor($device),
            $device
        );

    }



    private function fixFoundProducts($foundProducts, $device)
    {
        foreach ($foundProducts as $index => $product) {
            //normalize product title (may be ANYTHING)
            $productTitleR  = explode('for',$foundProducts[$index]['title']);

            $foundProducts[$index]['short_title'] = str_ireplace("iSkin","",$productTitleR[0]);
            $foundProducts[$index]['short_title'] = str_replace('-','-<br/>',$foundProducts[$index]['short_title']);

            if ($productTitleR[1]) {
                $foundProducts[$index]['tagline'] = 'for ' . $productTitleR[1];
            } else if ($foundProducts[$index]['relationship']) {
                $foundProducts[$index]['tagline'] = $foundProducts[$index]['relationship'] . ' ' . $device;
            } else {
                $foundProducts[$index]['tagline'] = 'recommended for ' . $device;
            }

            $foundProducts[$index]['group_shot_url'] = self::productImgPath($product['sku_base']);

            $foundProducts[$index]['display_price'] = self::formatProductPrice($foundProducts[$index]['price']);
        }

        return $foundProducts;
    }


    // Fix irregularities inconsistencies in legacy DB
    private function fixGlitches($foundOptions, $clearDisplayProduct = false)
    {

        $defaultProduct = null;
        $options = array();

        // Get first product option that is in stock
        foreach ($foundOptions as $item) {

            // Rearrange products by unique id (SKU)
            $options[$item['sku']] = $item;

            $options[($item['sku'])]['group_shot_url'] = self::productImgPath($item['sku_base']);
            $options[($item['sku'])]['option_shot_url'] = self::optionImgPath($item['sku_base'], $item['sku']);

            //build display values

            // use if option title is available, otherwise use product line title
            $options[($item['sku'])]['title'] = trim($item['title']) ?
                $item['title'] :
                $item['product']['display_title'];

            // hack Q.West title ( need Q.West for display, none in option titles )
            if ( preg_match('/Q.West/', $item['product']['display_title'])) {
                $options[($item['sku'])]['title'] = $item['product']['display_title'];
            }
            //normalize product title (may be ANYTHING)
            $productTitleR  = explode('for',$options[($item['sku'])]['title']);

            $options[($item['sku'])]['short_title'] = str_ireplace("iSkin","",$productTitleR[0]);
            $options[($item['sku'])]['short_title'] = str_replace('-','-<br/>',$options[($item['sku'])]['short_title']);

            if ($productTitleR[1]) $options[($item['sku'])]['tagline'] = 'for ' . $productTitleR[1];

            //title for the cart
            if ( isset($options[($item['sku'])]['description']) && $options[($item['sku'])]['description'] != '' ) {
                $options[($item['sku'])]['title'] .= " - " . $options[($item['sku'])]['description'];
            }
            if ( isset($options[($item['sku'])]['option']) && $options[($item['sku'])]['option']!='' ) {
                $options[($item['sku'])]['description'] = $options[($item['sku'])]['option'];
                $options[($item['sku'])]['title'] .= " - " . $options[($item['sku'])]['option'];
            }

            // Collections
            $productTitle = $options[($item['sku'])]['short_title'];
            if  ( stripos( $productTitle,'Gravity') !== false ) {
                $productTitle = str_ireplace('Gravity','',$productTitle);
                $options[($item['sku'])]['collection'] = '<span class="ui-li-aside collection gravity">iSkin Gravity Collection</span><br/>';
            }
            if  ( stripos( $productTitle,'Ducati') !== false ) {
                $productTitle = str_ireplace('Ducati','',$productTitle);
                $options[($item['sku'])]['collection_title'] = "Ducati";
                $options[($item['sku'])]['collection'] = '<span class="collection ducati">iSkin Ducati Collection</span><br/>';
            }
            if  ( stripos( $productTitle,'Q.West') !== false ) {
                $productTitle = str_ireplace('Q.West','',$productTitle);
                $options[($item['sku'])]['collection_title'] = "Q.West";
                $options[($item['sku'])]['collection'] = '<span class="ui-li-aside collection qwest">iSkin Q.West Collection</span><br/>';
            }
            if  ( stripos( $productTitle,'Silo') !== false ) {
                $productTitle = str_ireplace('Silo','',$productTitle);
                $options[($item['sku'])]['collection'] = '<span class="ui-li-aside collection Silo">iSkin Silo Collection</span><br/>';
            }
            if  ( stripos( $productTitle,'SOHO') !== false ) {
                $productTitle = str_ireplace('SOHO','',$productTitle);
                $options[($item['sku'])]['collection'] = '<span class="ui-li-aside collection Soho">iSkin Soho Collection</span><br/>';
            }
            if  ( stripos( $productTitle,'ProTouch') !== false ) {
                $productTitle = str_ireplace('w/Microban(R)','',$productTitle);
                $options[($item['sku'])]['collection'] = '<span class="ui-li-aside collection proTouch">with Microban&reg;</span><br/>';
            }

            $options[($item['sku'])]['short_title'] = $productTitle;

            // And so does price
            $options[($item['sku'])]['price'] = trim($item['price']) ? $item['price'] : $item['product']['price'];
            $options[($item['sku'])]['display_price'] = self::formatProductPrice($options[($item['sku'])]['price']);

            // Pick first option to display that is in stock
            if ($item['stock'] !== '0') {
                $defaultProduct = $options[$item['sku']];
            }
        }

        if (!$clearDisplayProduct) {
            $options['displayProduct'] = $defaultProduct;
        }

        return $options;
    }

    public static function formatProductPrice( $numericValue, $roundDown = false ) {
        // hack to round down marketing-friendly prices
        // (no truncating func in php)
        $formattedPrice = $roundDown? (floor($numericValue * 100)) / 100 : $numericValue;
        return money_format('%#2n', $formattedPrice );
    }

    public static function productImgPath($skubase, $path = '')
    {
        return Image::productSrc($skubase, $path);
    }

    public static function optionImgPath($skubase, $sku)
    {
        return Image::optionSrc($skubase, $sku);
    }


    public static function fetchProtouch()
    {
        $foundProducts = Xmas::find()
            ->selectAll()
            ->withProductLine()
            ->forCategory('covers')
            ->defaultOrder()
            ->asArray()
            ->all();

        foreach ($foundProducts as $index => $product) {
            $foundProducts[$index]['weight'] = $product['display_weight'];
            $foundProducts[$index]['group_shot_url'] = self::productImgPath($product['skubase'], 'promos/');
        }

        return $foundProducts;

    }

    public static function fetchForPromo($for = false, $category = false)
    {

        $allFoundProducts = array();
        $queryDevice = self::fetchDevice($for);
        if (!$queryDevice) {
            return null;
        }


        if ($for && $for != "all") {

            $query = Xmas::find();

            $queryDevice = self::fetchDevice($for);

            $query = $query
                ->select([
                    Xmas::tableName() . '.*',
                    Product::tableName() . '.*',
                    Compatibility::tableName() . '.*',
                ])
                ->joinWith('product')
                ->innerJoinWith('compatibility')
                ->where(['compatible_device_model' => $queryDevice]);

            if ($category && $category != "all") {
                $query = $query
                    ->andWhere(['category' => $category]);
            }

            $query = $query->defaultOrder();

            $allFoundProducts = $query->asArray()->all();

        } else {
            // TODO is this necessary?
            foreach(self::categories as $category) {

                if (is_array(
                    $foundProductsForCategory = Product::find()
                        ->compatibleWithForCategory($queryDevice, $category)
                        ->asArray()
                        ->all())) {

                    $allFoundProducts = array_merge(
                        $allFoundProducts,
                        $foundProductsForCategory
                    );
                }
            }
        }

        foreach ($allFoundProducts as $index => $product) {
            $allFoundProducts[$index]['weight'] = $product['display_weight'];
            $allFoundProducts[$index]['group_shot_url'] = self::productImgPath($product['skubase'], 'promos/');
        }
        return $allFoundProducts;
    }

    public static function fetchCollectionPromo($for, $collection)
    {

    }



}
