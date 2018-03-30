<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\collection\Collection */

$this->title = 'Update Collection: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Product Collections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="collection-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>