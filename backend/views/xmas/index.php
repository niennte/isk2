<?php

use backend\widgets\Product;
use common\widgets\Image;
use yii\grid\DataColumn;
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
    <style>
        table td img {
            max-width: 75px;
        }
    </style>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'skubase',
                'label' => 'Product',
                'format'=>'raw',
                'value'=> function(common\models\xmas\Xmas $data) {
                    return Product::indexSearchLink($data->skubase, $data->skubase);
                },
            ],
            'discount',
            'short_description',
            'reference_name',
            [
                'class' => DataColumn::class,
                'label' => 'Image',
                'format' => 'image',
                'value' => function($data)  {
                    return Image::productSrc($data->skubase, 'promos/');
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
