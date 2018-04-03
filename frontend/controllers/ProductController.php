<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\filter\Filters;

/**
 * ProductController implements custom product renderings and AJAX partial modules.
 */
class ProductController extends Controller
{

    /**
     * Renders view for iphone5c/exo
     * @return string
     */
    public function actionIphone5sClaro()
    {
        return $this->renderPartial(
            'iphone5s/claro', [
                'session' => [],
                'data' =>$this->addProduct("CLRO5S"),
                'incPath' => $_SERVER['DOCUMENT_ROOT'] . '/../legacy/archive/iphone5s-claro/inc.Claro.php',
                'localIncPath' => $_SERVER['DOCUMENT_ROOT'] . '/../legacy/archive/iphone5s-claro/',
            ]
        );
    }


    public function actionProductViewAjax5sGc($product)
    {
        return $this->renderPartial(
            'ajax/product-view-5s-gc', [
                'data' => $this->addProduct($product),
                'incPath' => $_SERVER['DOCUMENT_ROOT'] . '/../legacy/archive/php/templates/inc.ProductView.5S.GC.php',
            ]
        );
    }

    /**
     * Renders the inline products viewing module
     * @param $product
     * @param bool $discount
     * @return string
     */
    public function actionBuy($product, $discount = false)
    {
        return $this->renderPartial('ajax/buy', [
            'session' => [],
            'data' => [
                'productOptions' => Filters::fetchProductWithOptionsBySkubase($product),
                'displayDiscount' => !!$discount && $discount > 0,
                'discount' => $discount
            ],
            'incPath' => $this->getIncPath('Buy'),
        ]);
    }


    private function getIncPath($name) {
        return $_SERVER['DOCUMENT_ROOT'] . '/../legacy/archive/inc.' . $name . '.php';
    }

    /**
     * Populate product data
     * @return array
     */
    private function addProduct($skubase)
    {
        return [
            'skubase' => $skubase,
            'product' => Filters::fetchProductWithOptionsBySkubase($skubase, true),
            'baseImgPath' => Filters::BASE_IMG_PATH . $skubase,
            'imgPath' => Filters::BASE_IMG_PATH . $skubase . Filters::PRODUCT_IMG_PATH,
        ];
    }

}
