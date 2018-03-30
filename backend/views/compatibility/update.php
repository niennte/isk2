<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\compatibility\Compatibility */

$this->title = 'Update Compatibility: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Product Compatibilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="compatibility-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
