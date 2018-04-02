<?php

namespace frontend\controllers;


use yii\web\Controller;

class CheckoutController extends Controller
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->renderPartial('index', [
            'session' => [],
            'data' => [],
        ]);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionLight()
    {
        return $this->renderPartial('light', [
            'session' => [],
            'data' => [],
        ]);
    }

}