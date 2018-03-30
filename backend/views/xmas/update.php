<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\xmas\Xmas */

$this->title = 'Update Xmas Promo Record: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Product Promo Xmas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="xmas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
