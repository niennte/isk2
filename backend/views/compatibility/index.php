<?php

use backend\widgets\Product;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\compatibility\CompatibilitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Compatibilities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compatibility-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Product Compatibility', ['create'], ['class' => 'btn btn-success']) ?>
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
            'compatible_device_family',
            'compatible_device_model',
            'relationship',
            [
                'attribute'=>'product_skubase',
                'label' => 'Product',
                'format'=>'raw',
                'value'=> function($data) {
                    return Product::indexSearchLink($data->product_skubase, $data->product_skubase);
                },
            ],
            'product_reference_name',
            //'comments:ntext',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'actions'],
            ],
        ],
    ]); ?>
</div>
