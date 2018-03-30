<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\option\Option */

$this->title = 'Add Product Option';
$this->params['breadcrumbs'][] = ['label' => 'Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="option-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
