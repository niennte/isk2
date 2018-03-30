<?php

use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

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
                'class' => DataColumn::className(),
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
            'id',
            'sku',
            [
                'attribute'=>'sku_base',
                'label' => 'Product (SKU base)',
                'format'=>'raw',
                'value'=> function() use($model) {
                    $records = $model->getRelatedRecords();
                    $productLine = $records['product'];
                    return Html::a($model->sku_base, Url::to(['product/view', 'id' => $productLine->id]));
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
