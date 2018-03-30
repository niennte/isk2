<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\collection\Collection */

$this->title = 'Create Collection';
$this->params['breadcrumbs'][] = ['label' => 'Product Collections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collection-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
