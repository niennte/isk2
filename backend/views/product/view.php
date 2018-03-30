<?php

use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

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
                'class' => DataColumn::className(),
                'label' => 'Image',
                'format' => 'image',
                'value' => function($data)  {
                    $src = '/assets/img/'
                        . $data->sku_base;
                    $src = (file_exists($_SERVER['DOCUMENT_ROOT'] .'/'. $src.'.png')) ? $src.'.png' : $src.'.jpg';
                    return $src;
                },
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
                'value'=>Html::a(
                    $model->num_options,
                    Url::to(
                        ['option/index',
                            'ProductOptionSearch[sku_base]' => $model->sku_base]
                    )
                ),
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
                    'value'=>Html::a($option->sku, Url::to(['option/view', 'id' => $option->id])),
                ],
                'title',
                'description',
                [
                    'label' => 'Image',
                    'format' => 'image',
                    'value' => function($data)  {
                        // put family into a lookup array
                        $src = '/assets/img/'
                            . $data->sku_base
                            . '/shots/'
                            . $data->sku;
                        $src = (file_exists($_SERVER['DOCUMENT_ROOT'] .'/'. $src.'.png')) ? $src.'.png' : $src.'.jpg';
                        return $src;
                    },
                    'options' => ['style' => 'max-width: 50px;'],
                ],
            ],
        ]);
    }


    ?>



</div>
