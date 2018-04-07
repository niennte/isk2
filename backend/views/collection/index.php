<?php

use backend\widgets\Option;
use backend\widgets\Product;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\collection\CollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Collections';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collection-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Product To Collection', ['create'], ['class' => 'btn btn-success']) ?>
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
            //'product_sku',
            [
                'attribute'=>'product_sku',
                'format'=>'raw',
                'value'=> function($data) {
                    return Option::indexSearchLink($data->product_sku, $data->product_sku, 'sku');
                },
                'contentOptions' => ['class' => 'sku'],
            ],
            //'product_skubase',
            [
                'attribute'=>'product_skubase',
                'label' => 'Product',
                'format'=>'raw',
                'value'=> function($data) {
                    return Product::indexSearchLink($data->product_skubase, $data->product_skubase);
                },
            ],
            'collection_title',
            'comments:ntext',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'actions'],
            ],
        ],
    ]); ?>
</div>
