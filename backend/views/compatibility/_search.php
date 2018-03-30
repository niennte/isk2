<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\compatibility\CompatibilitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compatibility-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'compatible_device_family') ?>

    <?= $form->field($model, 'compatible_device_model') ?>

    <?= $form->field($model, 'relationship') ?>

    <?= $form->field($model, 'product_skubase') ?>

    <?php // echo $form->field($model, 'product_reference_name') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
