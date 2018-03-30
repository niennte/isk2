<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\collection\Collection */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="collection-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_skubase')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'collection_title')->dropDownList([ '' => '', 'Q.West' => 'Q.West', 'Ducati' => 'Ducati', 'Silo' => 'Silo', 'Happy Friends' => 'Happy Friends', 'other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
