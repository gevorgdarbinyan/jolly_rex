<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Venue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="venue-form">

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($userModel, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($userModel, 'password')->passwordInput(['maxlength' => true]); ?>

    <?= $form->field($userModel, 'status')->dropDownList(['Active' => 'Active','Pending'=>'Pending','Inactive' => 'Inactive'], ['prompt' => 'Status']); ?>

    <?= $form->field($userModel, 'user_type_id')->hiddenInput(['value' => 3])->label(false); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'support_instant_booking')->dropDownList([1 => 'Yes', 0 => 'No'], ['prompt' => 'Support instant booking']); ?>
    
    <?= $form->field($model, 'short_description')->textarea(['rows' => 6]) ?>

     <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'rating')->dropDownList([1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], ['prompt' => 'Rating']); ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
