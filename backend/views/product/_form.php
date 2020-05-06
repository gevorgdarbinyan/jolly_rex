<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Food */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="food-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'user_id')->textInput() ?> -->

    <?= $form->field($userModel, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($userModel, 'password')->passwordInput(['maxlength' => true]); ?>

    <?= $form->field($userModel, 'status')->dropDownList(['Active' => 'Active','Pending'=>'Pending','Inactive' => 'Inactive'], ['prompt' => 'Status']); ?>

    <?= $form->field($userModel, 'user_type_id')->hiddenInput(['value' => 5])->label(false); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'custom'
    ]) ?>

    <?= $form->field($model, 'delivery')->dropDownList([1 => 'Yes', 0 => 'No'], ['prompt' => 'Delivery']); ?>

    <?= $form->field($model, 'rating')->dropDownList([1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], ['prompt' => 'Rating']); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

