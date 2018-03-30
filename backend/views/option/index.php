<?php

use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\option\OptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Options';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="option-index">
    <style>
        table td img {
            max-width: 75px;
        }
    </style>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Product Option', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sku',
            'sku_base',
            'title',
            'description',
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
            //'option',
            //'display_weight',
            //'price',
            //'stock',
            //'discontinued',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
