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

}
