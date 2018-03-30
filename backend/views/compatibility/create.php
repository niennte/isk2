<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\compatibility\Compatibility */

$this->title = 'Create Compatibility';
$this->params['breadcrumbs'][] = ['label' => 'Product Compatibilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compatibility-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
