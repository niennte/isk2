<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\compatibility\Compatibility */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Compatibilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compatibility-view">

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
            'compatible_device_family',
            'compatible_device_model',
            'relationship',
            'product_skubase',
            'product_reference_name',
            'comments:ntext',
        ],
    ]) ?>

</div>
