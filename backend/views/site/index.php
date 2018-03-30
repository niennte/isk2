<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user string */

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome, <?= Html::encode($user) ?></h1>


        <p>Available models:</p>

        <div class="row">
            <div class="col-lg-offset-4 col-lg-4">
                <ul class="list-group">
                    <li class="list-group-item"><?php echo Html::a('Products', Url::to(['product/index'])) ?></li>
                    <li class="list-group-item"><?php echo Html::a('Options', Url::to(['option/index'])) ?></li>
                    <li class="list-group-item"><?php echo Html::a('Compatibilities', Url::to(['compatibility/index'])) ?></li>
                    <li class="list-group-item"><?php echo Html::a('Collections', Url::to(['collection/index'])) ?></li>
                    <li class="list-group-item"><?php echo Html::a('Promos', Url::to(['promo/index'])) ?></li>
                    <li class="list-group-item"><?php echo Html::a('xMas', Url::to(['xmas/index'])) ?></li>
                </ul>
            </div>
        </div>

    </div>

    <div class="body-content">

        <div class="row">



        </div>

    </div>
</div>
