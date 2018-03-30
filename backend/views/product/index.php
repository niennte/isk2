<?php

use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
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
    <style>
        table td img {
            max-width: 75px;
        }
    </style>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sku_base',
            //'title',
            //'description',
            //'specs:ntext',
            'display_title',
            [
                'class' => DataColumn::className(),
                'label' => 'Image',
                'format' => 'image',
                'value' => function($data)  {
                    // put family into a lookup array
                    $src = '/assets/img/'
                        . $data->sku_base;
                    $src = (file_exists($_SERVER['DOCUMENT_ROOT'] .'/'. $src.'.png')) ? $src.'.png' : $src.'.jpg';
                    return $src;
                },
                'options' => ['style' => 'max-width: 50px;'],
            ],
            //'specs:ntext',
            //'product_url:url',
            //'buy_url:url',
            //'category',
            //'type',
            //'display_weight',
            //'price',
            //'released',
            //'discontinued',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
