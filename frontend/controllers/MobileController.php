<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\filter\Filters;

/**
 * Controller for the `mobile` view
 */
class MobileController extends Controller
{

    public $layout = 'mobile';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'session' => [],
            'data' => [],
            'incPath' => $this->getIncPath('Index'),
        ]);
    }

    public function actionFilter($deviceFamily)
    {
        return $this->render('filter', [
            'session' => [],
            'data' => [
                'deviceFamily' => $deviceFamily,
                'productFilter' => Filters::productFilter,
                'smartPhones' => Filters::smartPhones,
                'macBooks' => Filters::macBooks,
                'laptopItems' => Filters::laptopItems,
                'specials' => Filters::specials,
                'specialItems' => Filters::specialItems,
            ],
            'incPath' => $this->getIncPath('Filter'),
        ]);
    }

    public function actionProducts($deviceModel)
    {
        return $this->render('products', [
            'session' => [],
            'data' => [
                'imgPath' => Yii::$app->params['customPaths']['imgPath'],
                'device' => $deviceModel,
                'contentDir' => Filters::fetchDeviceFamily($deviceModel),
                'queryDevice' => Filters::fetchDevice($deviceModel),
                'selectedProducts' => Filters::fetchProductsFor($deviceModel),
            ],
            'incPath' => $this->getIncPath('Products'),
        ]);
    }

    public function actionProduct($deviceModel, $product)
    {
        return $this->render('product', [
            'session' => [],
            'data' => [
                'device' => $deviceModel,
                'product' => $product,
                'options' => Filters::fetchProductWithOptions($product),
                'displayDevice' => Filters::fetchDevice($deviceModel),
            ],
            'incPath' => $this->getIncPath('Product'),
        ]);
    }

    public function actionSpecials($collection, $for, $layout)
    {
        // TODO: refactor from specials.php
        return $this->render('collection');
    }

    public function actionCart()
    {
        return $this->render('cart', [
            'session' => [],
            'data' => [],
            'incPath' => $this->getIncPath('Cart'),
        ]);
    }

    private function getIncPath($name) {
        return $_SERVER['DOCUMENT_ROOT'] . '/../legacy/mobile/inc.' . $name . '.php';
    }

}
