<?php

use backend\widgets\Option;
use backend\widgets\Product;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use common\widgets\Image;

/* @var $this yii\web\View */
/* @var $searchModel common\models\option\OptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Options';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="option-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Product Option', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'contentOptions' => ['class' => 'id'],
            ],
            [
                'attribute'=>'sku',
                'format'=>'raw',
                'value' => function($data)  {
                    return Option::viewLink($data->sku, $data->id);
                },
                'contentOptions' => ['class' => 'sku'],
            ],
            [
                'attribute'=>'sku_base',
                'format'=>'raw',
                'value' => function(common\models\option\Option $data)  {
                    $records = $data->getRelatedRecords();
                    $product = $records['product'];
                    return Product::viewLink($product->sku_base, $product->id);
                },
                'contentOptions' => ['class' => 'skubase'],
            ],
            'title',
            'description',
            //'option',
            //'display_weight',
            'price',
            'stock',
            //'discontinued',
            [
                'class' => DataColumn::className(),
                'label' => 'Image',
                'format' => 'image',
                'value' => function($data)  {
                    return Image::optionSrc($data->sku_base, $data->sku);
                },
                'contentOptions' => ['class' => 'image'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'actions'],
            ],

        ],
    ]); ?>
</div>
