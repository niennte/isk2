<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\xmas\Xmas */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Xmas Promo Listings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xmas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Product To Xmas Promo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'skubase',
            'discount',
            'short_description',
            'reference_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
