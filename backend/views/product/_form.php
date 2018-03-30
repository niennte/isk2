<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\product\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sku_base')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'display_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'specs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'product_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buy_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->dropDownList([ '' => '', 'cases' => 'Cases', 'accessories' => 'Accessories', 'carriers' => 'Carriers', 'covers' => 'Covers', 'other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'type')->dropDownList([ '' => '', 'bag' => 'Bag', 'backpack' => 'Backpack', 'sleeve' => 'Sleeve', 'sling' => 'Sling', 'folio' => 'Folio', 'pouch' => 'Pouch', 'other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'display_weight')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'released')->textInput() ?>

    <?= $form->field($model, 'discontinued')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
