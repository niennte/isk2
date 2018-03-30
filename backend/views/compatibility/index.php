<?php

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
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'compatible_device_family',
            'compatible_device_model',
            'relationship',
            'product_skubase',
            'product_reference_name',
            //'comments:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
