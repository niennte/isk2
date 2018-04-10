<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public $layout = 'responsive';

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
     * Renders the products view for the module
     * customized for the BF promo
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('bf', [
            'session' => [
                'cart' => Yii::$app->getSession()->get('cart'),
            ],
            'data' => [],
            'demoName' => 'bf',
            'incPath' => $this->getIncPath('BF.partial.wrapper'),
        ]);
    }

    private function getIncPath($name) {
        return $_SERVER['DOCUMENT_ROOT'] . '/../legacy/archive/inc.' . $name . '.php';
    }


}
