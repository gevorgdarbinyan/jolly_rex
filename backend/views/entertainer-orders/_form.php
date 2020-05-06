<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\entertainer\EntertainerOrders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entertainer-orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'entertainer_id')->textInput() ?>

    <?= $form->field($model, 'order_id')->textInput() ?>

    <?= $form->field($model, 'party_type_id')->textInput() ?>

    <?= $form->field($model, 'theme_service_id')->textInput() ?>

    <?= $form->field($model, 'additional_service_id')->textInput() ?>

    <?= $form->field($model, 'entertainer_package_id')->textInput() ?>

    <?= $form->field($model, 'event_date')->textInput() ?>

    <?= $form->field($model, 'start_time')->textInput() ?>

    <?= $form->field($model, 'end_time')->textInput() ?>

    <?= $form->field($model, 'entertainers_count')->textInput() ?>

    <?= $form->field($model, 'special_requests')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'price_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'host_child_age')->textInput() ?>

    <?= $form->field($model, 'host_child_gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'host_child_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telephone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'venue_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'post_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'entertainer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'info_status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
