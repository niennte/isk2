<?php

use common\widgets\Image;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\xmas\Xmas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Xmas Promo Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xmas-view">

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
            'id',
            'skubase',
            'discount',
            'short_description',
            'reference_name',
            [
                'class' => DataColumn::class,
                'label' => 'Image',
                'format' => 'image',
                'value' => function($data)  {
                    return Image::productSrc($data->skubase, 'promos/');
                },
                'options' => ['style' => 'max-width: 50px;'],
            ],
        ],
    ]) ?>

</div>
