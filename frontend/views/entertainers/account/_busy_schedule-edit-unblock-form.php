<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use yii\helpers\ArrayHelper;
use common\models\entertainer\EntertainerStaff;
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
            echo '<label>Date</label>';
            echo DatePicker::widget([
                'name' => 'EntertainerBusySchedule[busy_date1]', 
                //'value' => '2019-03-04,2019-03-05,2019-03-07',
                'value' => $entertainerBusySchedule['busy_date'],
                'options' => ['placeholder' => 'Date ...','class' => 'busy-date-class'],
                'type' => DatePicker::TYPE_INLINE,
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]);?>
        </div>
        <div class="form-group" style="margin-top:10px">
        <?php $checked = ($entertainerBusySchedule['busy_start_time'] == '' && $entertainerBusySchedule['busy_end_time'] == '') ? 'checked="checked"' : ''?>
            <label>All day</label>
            <input type="checkbox" class="all-day" <?=$checked;?> />
        </div>
    </div>
</div>
<div class="row time-container">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?=TimePicker::widget([
                        'name' => 'EntertainerBusySchedule[busy_start_time1]',
                        'value' => $entertainerBusySchedule['busy_start_time'],
                        'pluginOptions' => [
                            'showSeconds' => false,
                            'showMeridian' => false,
                        ],
                        'options' => [
                            'class' => 'busy-start-time-class'
                        ],
            ]);?>
            </div>
        </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?=TimePicker::widget([
                            'name' => 'EntertainerBusySchedule[busy_end_time1]',
                            'value' => $entertainerBusySchedule['busy_end_time'],
                            'value' => '',
                            'pluginOptions' => [
                                'showSeconds' => false,
                                'showMeridian' => false,
                            ],
                            'options' => [
                                'class' => 'busy-end-time-class'
                            ],
            ]);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
        <div class="form-group">
            <label>To block for the following reason</label>
            <?=Html::dropdownList('',$entertainerBusySchedule['reason'],[4=>'Blocked for extrenal client',5 => 'Sick leave',6=>'Away on holiday'] ,['class'=>'form-control block-reason']);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
        <div class="form-group">
            <div class="row">
                <?php foreach($entertainerStaff as $staff){ ?>
                    <?php $check = (in_array($staff['id'],$entertainerBusyScheduleStaffList)) ? 'checked="checked"' : '';?>
                    <div class="col-lg-4 col-md-4">
                        <div class="checkbox">
                            <label><input type="checkbox" value="<?=$staff['id'];?>" class="entertainer-staff" <?=$check;?>><?=$staff['first_name'].' '.$staff['last_name'];?></label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <span class="schedule-calendar-class" style="cursor:pointer;text-decoration:underline;">
                            Personal Calendar
                        </span>
                    </div>
                    
                    <div class="clearfix"></div>
                <?php } ?>
            </div>
        </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
        <div class="form-group">
            <?=Html::button('Update', ['class' => 'btn btn-primary update-busy-schedule', 'rel' => 0 ]);?>
            <?=Html::button('Unblock', ['class' => 'btn btn-success unblock-busy-schedule', 'rel' => 0]);?>
            </div>
        </div>
</div>