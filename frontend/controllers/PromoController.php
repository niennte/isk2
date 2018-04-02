<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\filter\Filters;

/**
 * Controller for the module rendering custom
 * and/or timed product listings, aka promos
 */
class PromoController extends Controller
{

    /**
     * Renders the products view for the module
     * customized for the XMas promo
     * @return string
     */
    public function actionXmas()
    {

        return $this->renderPartial('xmas', [
            'session' => [
                'cart' => Yii::$app->getSession()->get('cart'),
            ],
            'data' => [],
            'incPath' => $this->getIncPath('XMas'),
        ]);
    }

    /**
     * Renders the products view for the module
     * customized for the BF promo
     * @return string
     */
    public function actionBf()
    {
        return $this->renderPartial('bf', [
            'session' => [
                'cart' => Yii::$app->getSession()->get('cart'),
            ],
            'data' => [],
            'incPath' => $this->getIncPath('BF'),
        ]);
    }

    private function getIncPath($name) {
        return $_SERVER['DOCUMENT_ROOT'] . '/../legacy/archive/inc.' . $name . '.php';
    }

}
