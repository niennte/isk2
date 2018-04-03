<?php
namespace common\widgets;

Use Yii;

class Image
{
    /**
     * @param $skubase
     * @param bool|false $path
     * @return string
     */
    public static function productSrc($skubase, $path = false)
    {
        $url = Yii::$app->params['customPaths']['imgPath'] . $path . $skubase;
        return (self::uriExists($url.'.png')) ?
            $url.'.png' : $url.'.jpg';
    }

    /**
     * @param $skubase
     * @param $sku
     * @return string
     */
    public static function optionSrc($skubase, $sku)
    {
        $url = Yii::$app->params['customPaths']['imgPath'] . $skubase . '/shots/' . $sku;
        return (self::uriExists($url.'.png')) ?
            $url.'.png' : $url.'.jpg';
    }

    /**
     * @param $uri
     * @return bool
     *
     */
    private function uriExists($uri)
    {
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_HEADER, true);    // headers only
        curl_setopt($ch, CURLOPT_NOBODY, true);    // no body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpCode == '200';
    }

}