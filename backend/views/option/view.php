<?php

use backend\widgets\Product;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\widgets\Image;

/* @var $this yii\web\View */
/* @var $model common\models\option\Option */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="option-view">

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
                'value' => Image::optionSrc($model->sku_base, $model->sku),
                'options' => ['style' => 'max-width: 50px;'],
            ],
            'id',
            'sku',
            [
                'attribute'=>'sku_base',
                'label' => 'Product (SKU base)',
                'format'=>'raw',
                'value'=> function() use($model) {
                    $records = $model->getRelatedRecords();
                    $product = $records['product'];
                    return Product::viewLink($product->sku_base, $product->id);
                },
            ],
            'title',
            'description',
            'option',
            'display_weight',
            'price',
            'stock',
            'discontinued',
        ],
    ]) ?>

</div>
