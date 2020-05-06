<?php
/**
 * @TODO
 * 1. entertainer staff-y save anelu table sarqel.
 * 2. print uxxel
 * 3. Free time-y cuyc tal calendar-i vra
 * 4. block anelu functionality-n texapoxel calendar-i vra
 * 5. Amen mi entertainer-i schedule-y cuyc talu hnaravorutyun unenal.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use yii\helpers\ArrayHelper;
use common\models\entertainer\EntertainerStaff;
use dosamigos\ckeditor\CKEditor;
?>
<style>
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
    width:auto;
    padding:0 10px;
    border-bottom:none;
}
</style>
<div class="busy_schedule-form">
    <?php $form = ActiveForm::begin(['action' => ['entertainers/save-schedule']]); ?>
        <?= $form->field($model, 'entertainer_id')->hiddenInput()->label(false); ?>
        <div class="form-group">
                <?php
                echo '<label>Date</label>';
                echo DatePicker::widget([
                    'name' => 'EntertainerBusySchedule[busy_date]', 
                    'value' => $model->busy_date,
                    'options' => ['placeholder' => 'Date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);?>
        </div>
        <div class="form-group">
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <?php echo '<label>Time</label>';?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <?=TimePicker::widget([
                    'name' => 'EntertainerBusySchedule[busy_start_time]',
                    'value' => $model->busy_start_time,
                    'pluginOptions' => [
                        'showSeconds' => false,
                        'showMeridian' => false,
                    ],
                    'options' => [
                        'class' => 'busy-start-time'
                    ],
                ]);?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <?=TimePicker::widget([
                    'name' => 'EntertainerBusySchedule[busy_end_time]',
                    'value' => $model->busy_end_time,
                    'pluginOptions' => [
                        'showSeconds' => false,
                        'showMeridian' => false,
                    ],
                    'options' => [
                        'class' => 'busy-end-time'
                    ],
                ]);?>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php
        if($model->reason !== 1){
            echo $form->field($model, 'reason')->dropDownList([2 => 'Blocked Time', 3 => 'Blocked for Jolly Rex client',4=>'Blocked for external order'], ['prompt' => 'Reason']);
        }
        ?>
        <?= $form->field($model,'note')->widget(CKEditor::className(), [
                'options' => ['rows' => 6,'class'=>'entertainer-note-class'],
                'preset' => 'basic',
            ]) ?>
        <?= $form->field($model, 'id')->hiddenInput()->label(false); ?>
        <div class="form-group">
            <?= Html::button('Save', ['class' => 'btn btn-success schedule-save-button-class']) ?>
        </div>

        <?php if(!empty($order)){ ?>
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Acknowledge Order</legend>
            <div class="control-group">
                    <?=Html::dropdownList('','',ArrayHelper::map(EntertainerStaff::find()->where(['entertainer_id'=>$model->entertainer_id])->all(),'id','fullName'),['prompt'=>'Entertainers...','class'=>'form-control entertainer-staff-class','multiple'=>true]);?>
            </div>
            <div class="control-group">
            <?= $form->field($entertainerOrdersModel,'message')->widget(CKEditor::className(), [
                'options' => ['rows' => 6,'class'=>'entertainer-orders-message-class'],
                'preset' => 'basic',
            ]) ?>
            </div>
            <div class="form-group">
                <?= Html::button('Send', ['class' => 'btn btn-success send-acknowledgement-button-class']) ?>
            </div>
        </fieldset>
        <?php }?>
    <?php ActiveForm::end(); ?>
</div>
<?php if(!empty($order)){ ?>
<div id="order-container">
    <table class="table table-bordered">
        <tr>
            <th colspan="2">
                <div class="col-lg-11 col-md-11">
                Order detailed information
                </div>
                <div class="col-lg-1 col-md-1">
                <a><span class="glyphicon glyphicon-print print-button" style="cursor:pointer;"></span></a>
                </div>
            </th>
        </tr>
        <tr>
            <th>Party</th>
            <td>
                <?=$order['party_type_name'];?>
            </td>
        </tr>
        <tr>
            <th>
                Event date
            </th>
            <td>
            <?=$order['event_date'];?>
            </td>
        </tr>
        <tr>
            <th>
                Start time
            </th>
            <td>
                <?=$order['start_time'];?>
            </td>
        </tr>
        <tr>
            <th>
                End time
            </th>
            <td>
                <?=$order['end_time'];?>
            </td>
        </tr>
        <tr>
            <th>
                Entertainers count
            </th>
            <td>
                <?=$order['entertainers_count'];?>
            </td>
        </tr>
        <tr>
            <th>
                Child name
            </th>
            <td>
                <?=$order['host_child_name'];?>
            </td>
        </tr>
        <tr>
            <th>
                Child age
            </th>
            <td>
                <?=$order['host_child_age'];?>
            </td>
        </tr>
        <tr>
            <th>
                Child gender
            </th>
            <td>
                <?=($order['host_child_gender'] === 'male') ? 'Male' : 'Female';?>
            </td>
        </tr>
        <tr>
            <th>
                Special Requests
            </th>
            <td>
                <?=nl2br($order['special_requests']);?>
            </td>
        </tr>
        <tr>
            <th>
                Venue
            </th>
            <td>
                <?=($order['city']) ? ($order['city'].', '.$order['venue_address'].', '.$order['post_code']) : '';?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="pull-right">
                    Price:<?=$order['price'];?>
                </div>
            </td>
        </tr>
    </table>
</div>
<?php }?>