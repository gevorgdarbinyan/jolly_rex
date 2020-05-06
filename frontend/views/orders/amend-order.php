<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
use common\models\entertainer\EntertainerServices;
use \common\models\entertainer\EntertainerOrderPrices;
use common\models\entertainer\EntertainerPackages;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(['id'=>'amend-form']); ?>

    <div class="form-group">
        <?= $form->field($model, 'id')->hiddenInput(['class'=>'order-id-class'])->label(false); ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'customer_id')->hiddenInput()->label(false); ?>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'entertainer_id')->hiddenInput()->label(false); ?>
            Entertainer Name: <strong><?= $model->entertainer_relation->name; ?></strong>
    </div>
    <div class="form-group">
        <?php if($model->venue_id) : ?>
        <?= $form->field($model, 'venue_id')->hiddenInput()->label(false); ?>
        Venue Name: <strong><?= $model->venue_relation->name; ?></strong>
        <?php endif;?>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <?= TimePicker::widget([
                        'name' => 'Orders[start_time]',
                        'value' => $model->start_time,
                        'pluginOptions' => [
                            'showSeconds' => false,
                            'showMeridian' => false,
                        ],
                        'options' => [
                            'class' => 'start-time'
                        ],
            ]);?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?= TimePicker::widget([
                                    'name' => 'Orders[end_time]',
                                    'value' => $model->end_time,
                                    'pluginOptions' => [
                                        'showSeconds' => false,
                                        'showMeridian' => false,
                                    ],
                                    'options' => [
                                        'class' => 'start-time'
                                    ],
                ]);?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?php
        echo '<label>Event Date</label>';
        echo DatePicker::widget([
            'name' => 'Orders[event_date]', 
            'value' => $model->event_date,
            'options' => ['placeholder' => 'Event date ...'],
            'pluginOptions' => [
                'format' => 'dd-M-yyyy',
                'todayHighlight' => true
            ]
        ]);?>
    </div>

    <div>
        <?php
            if($model->price_type == 'service'){
                $entertainerPriceData = EntertainerServices::find()->where(['entertainer_id'=>$model->entertainer_id])->all();
                $entertainerOrderPriceData = EntertainerOrderPrices::find()->where(['entertainer_id'=>$model->entertainer_id, 'customer_id'=>$model->customer_id, 'order_id'=>$model->id])->all();
                $entertainerOrderPriceList = array_map(function($data){
                    return $data->entertainer_service_id;
                }, $entertainerOrderPriceData);
                if($entertainerPriceData){
                    echo $this->render('../entertainers/_services',['entertainerPriceData'=>$entertainerPriceData,'orderModel'=>$model,'entertainerOrderPriceList'=>$entertainerOrderPriceList]);
                }
            }else{
                $entertainerPackageData = EntertainerPackages::find()->where(['entertainer_id'=>$model->entertainer_id])->all();
                if($entertainerPackageData){
                    echo $this->render('../entertainers/_packages',['entertainerPackageData'=>$entertainerPackageData, 'orderModel'=>$model]);
                }
            }
        ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'special_request')->textArea(); ?>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'host_child_age')->textInput(); ?>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'host_child_gender')->radioList(['male' => 'male', 'female' => 'female'],['separator' => '<br>']); ?>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'host_child_name')->textInput(); ?>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'telephone_number')->textInput(); ?>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'venue_address')->textInput(); ?>
    </div>
    <div class="form-group">
        <?= Html::button('Save', ['class' => 'btn btn-success save-order-class']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>