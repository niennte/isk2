<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\xmas\Xmas */

$this->title = 'Add Product To Xmas Promo';
$this->params['breadcrumbs'][] = ['label' => 'Xmas Promo Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xmas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
