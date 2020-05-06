<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\entertainer\EntertainerOrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entertainer-orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'entertainer_id') ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'party_type_id') ?>

    <?= $form->field($model, 'theme_service_id') ?>

    <?php // echo $form->field($model, 'additional_service_id') ?>

    <?php // echo $form->field($model, 'entertainer_package_id') ?>

    <?php // echo $form->field($model, 'event_date') ?>

    <?php // echo $form->field($model, 'start_time') ?>

    <?php // echo $form->field($model, 'end_time') ?>

    <?php // echo $form->field($model, 'entertainers_count') ?>

    <?php // echo $form->field($model, 'special_requests') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'price_type') ?>

    <?php // echo $form->field($model, 'host_child_age') ?>

    <?php // echo $form->field($model, 'host_child_gender') ?>

    <?php // echo $form->field($model, 'host_child_name') ?>

    <?php // echo $form->field($model, 'telephone_number') ?>

    <?php // echo $form->field($model, 'venue_address') ?>

    <?php // echo $form->field($model, 'post_code') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'entertainer_name') ?>

    <?php // echo $form->field($model, 'message') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'info_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
