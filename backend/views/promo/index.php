<?php

use backend\widgets\Product;
use common\widgets\Image;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\promo\Promo */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Promo Listings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add product to Promo', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute'=>'skubase',
                'label' => 'Product',
                'format'=>'raw',
                'value'=> function($data) {
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
                'contentOptions' => ['class' => 'image'],
                'value' => function($data)  {
                    return Image::productSrc($data->skubase, 'promos/');
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'actions'],
            ],
        ],
    ]); ?>
</div>
