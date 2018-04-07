<?php

use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\widgets\Image;

/* @var $this yii\web\View */
/* @var $searchModel common\models\product\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'sku_base',
                'contentOptions' => ['class' => 'skubase'],
            ],
            //'title',
            //'description',
            //'specs:ntext',
            [
                'attribute' => 'display_title',
                'contentOptions' => ['class' => 'title'],
            ],
            [
                'attribute' => 'specs',
                'contentOptions' => ['class' => 'description'],
            ],
            //'product_url:url',
            //'buy_url:url',
            [
                'attribute' => 'category',
                'contentOptions' => ['class' => 'category'],
            ],
            [
                'attribute' => 'type',
                'contentOptions' => ['class' => 'type'],
            ],
            //'display_weight',
            [
                'attribute' => 'price',
                'contentOptions' => ['class' => 'price'],
            ],
            //'released',
            //'discontinued',
            [
                'class' => DataColumn::class,
                'label' => 'Image',
                'format' => 'image',
                'value' => function($data)  {
                    return Image::productSrc($data->sku_base);
                },
                'contentOptions' => ['class' => 'image'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'actions'],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
