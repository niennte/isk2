<?php

use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\widgets\Image;
use backend\widgets\Option;

/* @var $this yii\web\View */
/* @var $model common\models\product\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'class' => DataColumn::class,
                'label' => 'Image',
                'format' => 'image',
                'value' => Image::productSrc($model->sku_base),
                'options' => ['style' => 'max-width: 50px;'],
            ],
            'id',
            'sku_base',
            'title',
            'description',
            'display_title',
            'specs:ntext',
            'product_url:url',
            'buy_url:url',
            'category',
            'type',
            'display_weight',
            'price',
            'released',
            'discontinued',
            [
                'attribute'=>'num_options',
                'format'=>'raw',
                'value'=> Option::indexSearchLink($model->num_options, $model->sku_base),
            ],
        ],
    ]) ?>


    <h3>Product Options</h3>
    <?

    $related = $model->getRelatedRecords();
    $options = $related['options'];

    foreach($options as $option) {

        echo DetailView::widget([
            'model' => $option,
            'attributes' => [
                [
                    'attribute'=>'sku',
                    'format'=>'raw',
                    'value'=>Option::viewLink($option->sku, $option->id),
                ],
                'title',
                'description',
                [
                    'label' => 'Image',
                    'format' => 'image',
                    'value' => Image::optionSrc($option->sku_base, $option->sku),
                    'options' => ['style' => 'max-width: 50px;'],
                ],
            ],
        ]);
    }


    ?>



</div>
