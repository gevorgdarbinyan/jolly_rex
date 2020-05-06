<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Entertainer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entertainer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($userModel, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($userModel, 'password')->passwordInput(['maxlength' => true]); ?>

    <?= $form->field($userModel, 'status')->dropDownList(['Active' => 'Active','Pending'=>'Pending','Inactive' => 'Inactive'], ['prompt' => 'Status']); ?>

    <?= $form->field($userModel, 'user_type_id')->hiddenInput(['value' => 2])->label(false); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'support_instant_booking')->dropDownList([1 => 'Yes', 0 => 'No'], ['prompt' => 'Support instant booking']); ?>

    <?= $form->field($model, 'short_description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'custom'
    ]) ?>
    <?= $form->field($model, 'price_description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'custom'
    ]) ?>

    <?= $form->field($model, 'package_description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'custom'
    ]) ?>

    <?= $form->field($model, 'rating')->dropDownList([1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], ['prompt' => 'Rating']); ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'video')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'first_line_address')->textarea(['rows' => 6]) ?>
    
    <?=$form->field($model, 'post_code')->textInput(); ?>

    <?=$form->field($model, 'area')->textInput(); ?>
    
    <?=$form->field($model, 'city')->textInput(); ?>
    
    <?=$form->field($model, 'support_mileage')->checkbox(); ?>
    
    <?=$form->field($model, 'mileage_price')->textInput(); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
