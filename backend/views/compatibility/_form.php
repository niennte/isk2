<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\compatibility\Compatibility */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compatibility-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'compatible_device_family')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'compatible_device_model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'relationship')->dropDownList([ '' => '', 'for' => 'For', 'fits' => 'Fits', 'compatible with' => 'Compatible with', 'other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'product_skubase')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_reference_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
