<?php
namespace frontend\controllers;

use yii\web\Controller;

/**
 * Controller for legacy checkout simulator
 */
class CheckoutController extends Controller
{

    /**
     * Renders the index view for the module
     * (simulate cart HTML view)
     * @return string
     */
    public function actionIndex()
    {
        return $this->renderPartial('index', [
            'session' => [],
            'data' => [],
            'incPath' => $this->getIncPath('index')
        ]);
    }

    /**
     * Renders the light view for the module
     * (simple cart operations with no HTML returned)
     * @return string
     */
    public function actionLight()
    {
        return $this->renderPartial('light', [
            'session' => [],
            'data' => [],
            'incPath' => $this->getIncPath('checkoutLight')
        ]);
    }

    private function getIncPath($name) {
        return $_SERVER['DOCUMENT_ROOT'] . '/../legacy/checkout/' . $name . '.php';
    }

}