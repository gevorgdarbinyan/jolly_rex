<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>
<h1><?= Html::encode('Order') ?></h1>
<div class="orders-form">

    <?php $form = ActiveForm::begin(['options' => ['action' => '','id'=>'order-form']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>

    <?= $form->field($model, 'entertainer_id')->hiddenInput(['value'=>$entertainerID])->label(false); ?>

    <!--<?= $form->field($model, 'event_date')->textInput()->label('Celebration date'); ?>
    <!--<?= $form->field($model, 'start_time')->textInput()->label('Celebration time'); ?>
    <?= $form->field($model, 'end_time')->textInput() ?>-->

    <?php
        echo '<label>Start Date/Time</label>';
        echo DateTimePicker::widget([
            'name' => 'Orders[start_date]',
            'options' => ['placeholder' => 'Select event start time ...'],
            //'convertFormat' => true,
            'pluginOptions' => [
                //'format' => 'yyyy-mm-dd h:i',
                'format' => 'yyyy-mm-dd HH:ii:ss',
                'autoclose' => true,
                'startDate' => date('Y-m-d H:i:s'),
                //'todayHighlight' => true
            ]
        ]);
    ?>

    <?php
        echo '<label>End Date/Time</label>';
        echo DateTimePicker::widget([
            'name' => 'Orders[end_date]',
            'options' => ['placeholder' => 'Select event end time ...'],
            //'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd HH:ii:ss',
                'autoclose'=> true,
                'startDate' => date('Y-m-d H:i:s'),
                //'todayHighlight' => true
            ]
        ]);
    ?>

    <?= $form->field($model, 'special_request')->textarea(); ?>

    <?= $form->field($model, 'status')->hiddenInput(['value' => 'Pending'])->label(false); ?>

    <div class="form-group">
        <!--<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>-->
        <?= Html::button('Save', ['class' => 'btn btn-success to-order-class']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>