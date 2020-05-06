<?php
use common\models\Entertainer;
use common\models\entertainer\EntertainerBusySchedule;
use common\models\entertainer\EntertainerBusyScheduleStaff;
use common\models\entertainer\EntertainerOrders;
use frontend\components\EntertainerWidget;
use frontend\components\EntertainerScheduleWidget;
use yii\helpers\Html;
use yii\web\View;
use \yii2fullcalendar\yii2fullcalendar;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
use dosamigos\ckeditor\CKEditorInline;
use dosamigos\ckeditor\CKEditor;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\entertainer\EntertainerStaff;
use common\models\entertainer\EntertainerOrdersStaff;
use yii\bootstrap\Modal;
use dosamigos\chartjs\ChartJs;

use kartik\rating\StarRating;

$this->registerCssFile("@web/css/entertainers/account/content.css");
$this->registerJsFile('@web/js/entertainer/account/content.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$userID = Yii::$app->user->identity->id;
$entertainer = Entertainer::find()->where(['user_id'=>$userID])->one();
$entertainerID = $entertainer['id'];

$times = [
    '08:00'=>'08:00','08:15'=>'08:15','08:30'=>'08:30','08:45'=>'08:45',
    '09:00'=>'09:00','09:15'=>'09:15','09:30'=>'09:30','09:45'=>'09:45',
    '10:00'=>'10:00','10:15'=>'10:15','10:30'=>'10:30','10:45'=>'10:45',
    '11:00'=>'11:00','11:15'=>'11:15','11:30'=>'11:30','11:45'=>'11:45',
    '12:00'=>'12:00','12:15'=>'12:15','12:30'=>'12:30','12:45'=>'12:45',
    '13:00'=>'13:00','13:15'=>'13:15','13:30'=>'13:30','13:45'=>'13:45',
    '14:00'=>'14:00','14:15'=>'14:15','14:30'=>'14:30','14:45'=>'14:45',
    '15:00'=>'15:00','15:15'=>'15:15','15:30'=>'15:30','15:45'=>'15:45',
    '16:00'=>'16:00','16:15'=>'16:15','16:30'=>'16:30','16:45'=>'16:45',
    '17:00'=>'17:00','17:15'=>'17:15','17:30'=>'17:30','17:45'=>'17:45',
    '18:00'=>'18:00','18:15'=>'18:15','18:30'=>'18:30','18:45'=>'18:45',
    '19:00'=>'19:00','19:15'=>'19:15','19:30'=>'19:30','19:45'=>'19:45',
    '20:00'=>'20:00','20:15'=>'20:15','20:30'=>'20:30','20:45'=>'20:45',
    '21:00'=>'21:00','21:15'=>'21:15','21:30'=>'21:30','21:45'=>'21:45',
    '22:00'=>'22:00'
    ];
?>
<input type="hidden" class="entertainer-id-class" value="<?=$entertainerID;?>" />
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
                    <h4 class="panel-title">
                    <span style="font-size: 30px;letter-spacing: 3px;">My Schedule</span>
                    </h4>
                </div>
                <div id="schedule" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="panel-group">
                            <!--  -->
                            <div>
                                <span class="pull-right block-button-class"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                <h4 class="panel-title">
                                    <span style="font-size: 30px;letter-spacing: 3px;color:red;">Block</span>
                                </h4>
                            </div>
                            <div id="block-container" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well" style="display:none;padding: 20px;margin-bottom: 10px;">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <?php
                                            echo '<label>Date</label>';
                                            echo DatePicker::widget([
                                                'name' => 'EntertainerBusySchedule[busy_date]', 
                                                //'value' => '2019-03-04,2019-03-05,2019-03-07',
                                                'value' => '',
                                                'options' => ['placeholder' => 'Date ...','class' => 'busy-date-class'],
                                                // 'type' => DatePicker::TYPE_INLINE,
                                                'pluginOptions' => [
                                                    'format' => 'yyyy-mm-dd',
                                                    'todayHighlight' => true,
                                                    'multidate' => true,
                                                ]
                                            ]);?>
                                        </div>

                                        <div class="form-group" style="margin-top:10px">
                                            <label>Whole day</label>
                                            <input type="checkbox" class="all-day" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row time-container">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <?=Html::dropdownList('EntertainerBusySchedule[busy_start_time]','',$times,['class' => 'form-control busy-start-time-class']);?>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <?=Html::dropdownList('EntertainerBusySchedule[busy_end_time]','',$times,['class' => 'form-control busy-end-time-class']);?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
                                        <div class="form-group">
                                            <label>To block for the following reason</label>
                                            <!-- <?=Html::dropdownList('','',[2=>'Blocked time',3=>'Blocked for Jolly Rex client',4=>'Blocked for extrenal client'] ,['prompt'=>'Reason','class'=>'form-control block-reason']);?> -->
                                            <?=Html::dropdownList('','',[4=>'Blocked for extrenal client',2 => 'Unavailable'] ,['class'=>'form-control block-reason']);?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
                                        <div class="form-group">
                                            <?=Html::dropdownList('','',ArrayHelper::map(EntertainerStaff::find()->where(['entertainer_id'=>$entertainerID])->all(),'id','fullName'),['prompt'=>'Entertainers...','class'=> 'form-control entertainer-staff-list-class','multiple'=>true]);?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
                                        <div class="form-group">
                                            <?=Html::button('Block', ['class' => 'btn btn-primary reserve-busy-schedule', 'rel' => $entertainerID]);?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <hr />
                            </div>

                            <div>
                                <span class="pull-right filter-options-button-class filter-options-container-collapsed"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                <h4 class="panel-title">
                                    <span style="font-size: 30px;letter-spacing: 3px;color:#337ab7;">Filter options</span>
                                </h4>
                            </div>
                            <div id="filter-options-container">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <?=Html::dropdownList('','',['01'=>'Jan','02'=>'Feb','03'=>'March','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec'] ,['prompt'=>'Month','class'=>'form-control schedule-month-class']);
                                    ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <?=Html::dropdownList('','',[] ,['prompt'=>'Week','class'=>'form-control schedule-week-class']);?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <?=Html::dropdownList('','',[],['prompt'=>'Day','class'=>'form-control schedule-day-class']);?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option>Filter By</option>
                                                <option value="All">All</option>
                                                <option value="External order">External order</option>
                                                <option value="Jolly Rex Orders">Jolly Rex Orders</option>
                                                <option value="Unavailable">Unavailable</option>
                                                <optgroup label="Pending">
                                                    <option value="All Pending">All Pending</option>
                                                    <option value="Pending Unacknowledged Orders">Pending Unacknowledged Orders(Jolly Rex only)</option>
                                                    <option value="Pending Acknowledged Orders">Pending Acknowledged Orders (Jolly Rex only)</option>
                                                </optgroup>
                                                <option value="FulFilled Orders">FulFilled Orders</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <?=Html::dropdownList('','',ArrayHelper::map(EntertainerStaff::find()->where(['entertainer_id'=>$entertainer['id']])->all(),'id','fullNameAbbr'),['prompt'=>'Entertainer...','class'=>'form-control entertainer-filter-staff-class','multiple'=>true]);?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <?=Html::button('Search',['class'=>'btn btn-success schedule-search-button']);?>
                                    </div>
                                </div>
                            </div>
                            <div id="schedule-content">
                                <?=EntertainerScheduleWidget::widget(['entertainerID' => $entertainerID, 'year' => '', 'month' => '','week'=>'','day' => 0, 'type'=>'All','entertainer'=>0]);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel-group">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <span class="pull-right clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-down"></i></span>
                    <h4 class="panel-title">
                        <span style="font-size: 30px;letter-spacing: 3px;">My Orders</span>
                    </h4>
                </div>
                <div id="orders" class="panel-collapse collapse in">
                    <div class="panel-body" style="display:none;">
                        <ul class="nav nav-tabs">
                            <li><a data-toggle="tab" href="#pending-orders">Pending Orders</a></li>
                            <li><a data-toggle="tab" href="#enquiries">Fullfilled Orders</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="pending-orders" class="tab-pane fade">
                                <?php
                                $year = date('Y');
                                $month = date('m');
                                $monthWordShort = date('M');
                                
                                $pendingOrders = [];
                                foreach($entertainerOrders as $order){
                                    $pendingOrders[$order['event_date']][] = $order;
                                }
                                $weeks = Yii::$app->Helper->weeksInMonth($month,$year);
                                ?>
                                <div class="container-flaud">
                                    <div class="panel-group">
                                    <?php foreach($weeks as $weekNum => $weekDates){
                                        $count = count($weekDates);?>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <?php $firstDate = new DateTime($weekDates[0]);
                                                $firstDayDate = $firstDate->format('d');
                                                $lastDate = new DateTime($weekDates[$count - 1]);
                                                $lastDayDate = $lastDate->format('d');
                                                echo $weekNum.' '.$monthWordShort.' '.$firstDayDate .' - '.$monthWordShort.' '.$lastDayDate;?>
                                                <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                            </div>
                                            <div class="panel-body" id="<?=$weekNum?>">
                                                <div class="panel-group">
                                                    <?php foreach($weekDates as $weekDate){
                                                        $date = new DateTime($weekDate);
                                                        $day = $date->format('l').'---'.$weekDate;?>
                                                        <div class="panel panel-info">
                                                            <div class="panel-heading">
                                                                <?=$day;?>
                                                            </div>
                                                            <div class="panel-body">
                                                                <?php if(!empty($pendingOrders[$weekDate])) {
                                                                    $dayOrders = $pendingOrders[$weekDate];
                                                                    $count = count($dayOrders);
                                                                    $i = 0;?>
                                                                    <div class="row">
                                                                    <?php foreach($dayOrders as $order) {
                                                                        $entertainerStaff = EntertainerStaff::find()->where(['entertainer_id'=>$order['entertainer_id']])->asArray()->all();
                                                                        $entertainerOrdersStaffData = EntertainerOrdersStaff::find()->where(['entertainer_order_id'=>$order['id']])->all();
                                                                        $entertainerOrdersStaff = array_map(function($item){return $item['entertainer_staff_id'];}, $entertainerOrdersStaffData);
                                                                        if($count >= 4){
                                                                            $blockCount = 3;
                                                                            $col = 4;
                                                                        }else{
                                                                            $blockCount = 2;
                                                                            $col = 6;
                                                                        }
                                                                        if($i != 0 && $i % $blockCount == 0 ){?>
                                                                            <div class="clearfix">
                                                                            </div>
                                                                        <?php } ?>
                                                                        <div class="col-lg-<?=$col;?>" col-md-<?=$col;?>">
                                                                            <div class="col-lg-12 col-md-12">
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-bordered pending-orders-table" cellspacing="0" cellpadding="0">
                                                                                        <tr style="background-color:#e1fbd8 !important;">
                                                                                            <th class="small">
                                                                                                Order &numero; : <?=$order['id'];?>
                                                                                            </th>
                                                                                            <th class="small">
                                                                                                <?= $order['party_type_name'] . '('.$order['host_child_name']. ')';?>
                                                                                            </th>
                                                                                            <th class="small">
                                                                                                <span style="color:red;">
                                                                                                    <?=$order['status'];?>
                                                                                                </span>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <tr class="info">
                                                                                        <th class="small">
                                                                                            Event Time
                                                                                        </th>
                                                                                        <th class="small">
                                                                                            Payment date
                                                                                        </th>
                                                                                        <th class="small">
                                                                                            Price
                                                                                        </th>
                                                                                        </tr>
                                                                                        <tr style="background-color:#ffffcc !important;">
                                                                                        <td class="small" style="width:30%;">
                                                                                        <?php
                                                                                            $startTimeObj = new DateTime($order['start_time']);
                                                                                            $startTime = $startTimeObj->format('H:i');
                                                                                            $endTimeObj = new DateTime($order['end_time']);
                                                                                            $endTime = $endTimeObj->format('H:i');
                                                                                            echo $startTime.'-'.$endTime;
                                                                                        ?>
                                                                                        </td>
                                                                                        <td colspan="2">
                                                                                            <?= $order['price'];?>
                                                                                        </td>
                                                                                        </tr>
                                                                                        <tr style="background-color:#e1fbd8 !important;">
                                                                                            <td class="small" style="width:10%" colspan="3">
                                                                                                <div class="row">
                                                                                                    <?php foreach($entertainerStaff as $entertainer){ ?>
                                                                                                        <?php if(in_array($entertainer['id'],$entertainerOrdersStaff)) { ?>
                                                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                                                <div class="checkbox">
                                                                                                                    <input type="hidden" value="<?=$entertainer['id'];?>" class="entertainer-staff-member-class" />
                                                                                                                    <label><?=$entertainer['first_name'].' '.$entertainer['last_name']?></label>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        <?php } ?>
                                                                                                    <?php } ?>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr style="background-color:#ffffcc !important;">
                                                                                            <td colspan="3">
                                                                                                <a href="entertainers/entertainer-order-detailed-info?id=<?=$order['order_id'];?>" target="_blank" style="cursor:pointer;color:#337ab7;font-size: 10.5px;">Details</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php $i++;
                                                                    }?>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div>
                        </div>
                        <div id="enquiries" class="tab-pane fade">
                            Fullfilled Orders
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <?php //if(isset($entertainer['support_instant_booking']) && !$entertainer['support_instant_booking']) : ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel-group">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <span class="pull-right clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-down"></i></span>
                    <h4 class="panel-title">
                    <span style="font-size: 30px;letter-spacing: 3px;">My Enquiries</span>
                    </h4>
                </div>
                <div id="enquiry" class="panel-collapse collapse in">
                    <div class="panel-body" style="display:none;">
                        <div class="row">
                        <?php foreach($entertainerEnquiries as $enquiry) {
                            $option1Date = $enquiry['option1_date'];
                            $option1StartTime = $enquiry['option1_start_time'];
                            $option1EndTime = $enquiry['option1_end_time'];

                            $option2Date = $enquiry['option2_date'];
                            $option2StartTime = $enquiry['option2_start_time'];
                            $option2EndTime = $enquiry['option2_end_time'];

                            $option3Date = $enquiry['option3_date'];
                            $option3StartTime= $enquiry['option3_start_time'];
                            $option3EndTime = $enquiry['option3_end_time'];

                            $option1DateObj = new DateTime($option1Date);
                            $newOption1Date = $option1DateObj->format('l, F d, Y');
                            $option1StartTimeObj = new DateTime($option1StartTime);
                            $newOption1StartTime = $option1StartTimeObj->format('H:i');
                            $option1EndTimeObj = new DateTime($option1EndTime);
                            $newOption1EndTime = $option1EndTimeObj->format('H:i');

                            $option2DateObj = new DateTime($option2Date);
                            $newOption2Date = $option2DateObj->format('l, F d, Y');
                            $option2StartTimeObj = new DateTime($option2StartTime);
                            $newOption2StartTime = $option2StartTimeObj->format('H:i');
                            $option2EndTimeObj = new DateTime($option2EndTime);
                            $newOption2EndTime = $option2EndTimeObj->format('H:i');

                            $option3DateObj = new DateTime($option3Date);
                            $newOption3Date = $option3DateObj->format('l, F d, Y');
                            $option3StartTimeObj = new DateTime($option3StartTime);
                            $newOption3StartTime = $option3StartTimeObj->format('H:i');
                            $option3EndTimeObj = new DateTime($option3EndTime);
                            $newOption3EndTime = $option3EndTimeObj->format('H:i');
                            ?>
                            <div class="col-lg-6 col-md-6">
                                <h4>Enquiry details</h4>
                                <table class="table table-bordered pending-orders-table" cellspacing="0" cellpadding="0">
                                    <tr style="background-color:#e1fbd8 !important;">
                                        <th class="small">
                                            Enquiry &numero; : <?=$enquiry['id'];?>
                                        </th>
                                        <th class="small">
                                            <?=$enquiry['party_type_name'] . '('.$enquiry['host_child_name']. ')';?>
                                        </th>
                                        <th class="small">
                                            <span style="color:red;">
                                                <?php
                                                    $statusString = '';
                                                    if($enquiry['status'] == 'to_confirm') {
                                                        $statusString = 'To confirm';
                                                    }elseif($enquiry['status'] == 'confirmed') {
                                                        $statusString = 'Confirmed';
                                                    }else{
                                                        $statusString = 'Being discussed';
                                                    }
                                                    echo $statusString;
                                                ?>
                                            </span>
                                        </th>
                                    </tr>
                                    <tr class="info">
                                        <th class="small" colspan="3">
                                            Chosen date/times for event from customer.
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><?=$newOption1Date .', ' . $newOption1StartTime . ' - ' .  $newOption1EndTime;?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><?=$newOption2Date .', ' . $newOption2StartTime . ' - '  .  $newOption2EndTime;?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><?=$newOption3Date .', ' . $newOption3StartTime . ' - '  .  $newOption3EndTime;?></td>
                                    </tr>
                                    <?php if($enquiry['status'] == 'confirmed') {?>
                                    <tr>
                                        <td class="small" colspan="3">
                                            Order &numero; : <?=$enquiry['order_id'];?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr style="background-color:#ffffcc !important;">
                                        <td colspan="3">
                                            <a href="entertainers/entertainer-enquiry-detailed-info/?id=<?=$enquiry['id'];?>" class="btn btn-link" target="_blank">Details</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <h4>Survey questions</h4>
                                <table class="table table-striped" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <th>Party Type</th>
                                        <td><?=$enquiry['party_type_name'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Entertainers count</th>
                                        <td><?=$enquiry['entertainers_count'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Age of Host Child at the event date</th>
                                        <td><?=$enquiry['host_child_age'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Gender of Host Child</th>
                                        <td><?=$enquiry['host_child_gender'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Name of Host Child</th>
                                        <td><?=$enquiry['host_child_name']?></td>
                                    </tr>
                                    <tr>
                                        <th>Special Requests</th>
                                        <td><?=$enquiry['special_requests'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Location</th>
                                        <td><?=$enquiry['post_code'];?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><hr /></div>
                        <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php //endif; ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                   Individual Staff Calendar
                </div>
                <div class="panel-body">
                    <?php
                        if(!empty($staff)) {
                            $events = [];
                            $count = count($staff);
                            $col = intdiv(12, $count);
                            foreach($staff as $staffID => $lists){
                                ?><div class="col-lg-<?=$col;?> col-md-<?=$col;?> col-sm-12 col-xs-12"><?php
                                $entertainerStaffData = EntertainerStaff::findOne($staffID);
                                ?><h4><?=$entertainerStaffData['first_name'].' '.$entertainerStaffData['last_name'];?></h4><?php
                                foreach($lists as $list) {
                                    $startDate = (!empty($list['event_date'])) ? $list['event_date'].'T'.$list['start_time'] : $list['busy_date'].'T'.$list['busy_start_time'];
                                    $endDate = (!empty($list['event_date'])) ? $list['event_date'].'T'.$list['end_time'] : $list['busy_date'].'T'.$list['busy_end_time'];
                                    $title = (!empty($list['event_date'])) ? 'Jolly Rex order' : 'Blocked time';
                                    $event        = new \yii2fullcalendar\models\Event();
                                    $event->id    = $list['id'];
                                    $event->title = $title;
                                    $event->start = $startDate;
                                    $event->end = $endDate;
                                    $event->color = '#ccc';
                                    $event->textColor = '';
                                    $event->className = 'event-class';
                                    $event->resourceId = 'a';
                                    $event->nonstandard = [
                                        'entertainer' => 'Tom Smith',
                                        'party_type' => 'Birthday',
                                        'child' => 'Mike',
                                    ];
                                    $events[]     = $event;
                                }
                                echo yii2fullcalendar::widget(array(
                                        'events' =>$events,
                                        'options' => [
                                            'id' =>'schedule-calendar'.$entertainerStaffData['first_name'].'-'.$entertainerStaffData['last_name'],
                                        ],
                                        'clientOptions' => [
                                            'header' => ['right' => 'agendaWeek,agendaDay,listMonth'],
                                            'editable' => true,
                                            'draggable' => true,
                                            'selectHelper' => true,
                                            //'timeFormat' => 'h(:mm)t',
                                            //'timeFormat' => 'h(:mm)',
                                            'timeFormat' => 'h:mm',
                                            'axisFormat' => 'H(:mm)',
                                            'displayEventEnd' => true,
                                            'defaultView' => 'agendaWeek',
                                            'columnFormat' => 'dddd',
                                            'firstDay' => 1,
                                            'minTime' => "08:00:00",
                                            'maxTime' => "22:00:00",
                                            /*'event_time_format' => [ // like '14:30:00'
                                                'hour' => '2-digit',
                                                'minute' => '2-digit',
                                                
                                            ],*/
                                            'dayClick' => new \yii\web\JsExpression('
                                                function (date, jsEvent, view) {
                                                    var dateValue = date.format();
                                                    var dateExpression = new Date(dateValue);
                                                    var toDateString = dateExpression.toDateString();
                                                    var entertainerID = '.Yii::$app->user->identity->id.';

                                                    $(".fc-day").not($(this)).not(".fc-today").css("background-color", "white");
                                                    //console.log($(".fc-day").hasClass("fc-past"));
                                                    /*if($(".fc-day").hasClass("fc-past")){
                                                        $(".fc-past").not($(this)).not(".fc-today").css("background-color", "#f2f2f2");
                                                    }*/
                                                    
                                                    $(this).css("background-color", "#4da6ff");
                                                    $(this).addClass("markedDay");
                                                    $(".selected-date").html(toDateString);
                                                    $(".selected-date-class").val(dateValue);
                                                    $("#time-container").show();
                                                    $("#modal-schedule-content").modal("show");
                                                }'
                                            ),
                                            'dayRender' => new \yii\web\JsExpression('
                                                function (date, cell) {
                                                    if($(cell[0]).hasClass("fc-past")){
                                                        cell.css("background-color","#f2f2f2");
                                                    }else{
                                                        cell.css("background-color","rgb(192, 249, 196)");
                                                    }
                                                    var day = $.fullCalendar.formatDate(date,"YYYY-MM-DD");
                                                    if(busyDays.indexOf(day) !== -1){
                                                        cell.css("background-color","#ebebe0");
                                                    }else{
                                                        //cell.css("background-color", "#b3ffb3");
                                                    }
                                                }'
                                            ),
                                            'eventClick' => new \yii\web\JsExpression('function(calEvent, jsEvent, view){
                                                $(this).css("border-color", "red");
                                                $.ajax({
                                                    url: App.base_path + "entertainers/busy-schedule-form",
                                                    type: "POST",
                                                        data: { id:calEvent.id},
                                                        success: function(data) {
                                                            $("#schedule-modal").modal("show")
                                                            .find("#schedule-modal-content").html(data);
                                                            $(".busy-start-time").timepicker();
                                                            $(".busy-end-time").timepicker();
                                                            // $(".entertainer-note-class").ckeditor();
                                                            //$(".entertainer-orders-message-class").ckeditor();
                                                            
                                                        }
                                                });
                                            }'),
                                            'eventRender' => new \yii\web\JsExpression('function(calEvent, jsEvent, view) {
                                                // console.log(calEvent.title + " -- " + calEvent.description);
                                                // console.log(view);
                                                // var title = jsEvent.find( ".fc-title" );
                                                // console.log(title);
                                                // console.log(title.text());
                                                // title.html( title.text() );
                                                // console.log(title.text());
                                            }'),
                                            'eventResize' => new \yii\web\JsExpression("
                                                function(event, delta, revertFunc, jsEvent, ui, view) {
                                                    console.log(event);
                                            }"),
                                        ]
                                        
                                ));
                                ?></div><?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label>My Ideas/Plans</label>
            <?=Html::textarea('','',['class'=>'form-control']);?>
            <?=Html::button('Save',['class'=>'btn btn-success']);?>
        </div>
    </div>
</div>
<?php

Modal::begin([
    'id' => 'order-details-modal',
    'size' => 'modal-lg',
    'header' => 'Order Details'
]);
?>
<div id="order-details-modal-content">
   
</div>
<?php
Modal::end();


Modal::begin([
    'id' => 'make-notes-orders-modal',
    'size' => 'modal-lg'
]);
?>
<div id="make-notes-orders-modal-content">
   
</div>
<div id="note-container">
<p></p>
<?php $form = ActiveForm::begin(); ?>
<?php 
$entertainerOrdersModel = new \common\models\entertainer\EntertainerOrders; 
$noteValue = \common\models\entertainer\EntertainerOrders::find()->where(['entertainer_id'=>$entertainerID,'order_id'=>10])->one()['note'];
$entertainerOrdersModel->note = $noteValue;
?>
<?= $form->field($entertainerOrdersModel,'note')->widget(CKEditor::className(), [
        'options' => ['rows' => 6,'class =entertainer-note-class'],
        'preset' => 'basic',
    ]) ?>
<?php ActiveForm::end(); ?>
<?=Html::button('Save', ['class' => 'btn btn-success save-note',]); ?>
</div>
<?php
Modal::end();


Modal::begin([
    'id' => 'acknowledge-order-modal',
    'size' => 'modal-md'
]);
?>
<div id="acknowledge-order-modal-content">
    <div class="text-center"><h3>Please acknowledge your new order!</h3></div>
    <div class="form-group">
        <label>Entertainer Name:</label>
        <?=Html::textInput('','',['class'=>'form-control entertainer-name-class']);?>
    </div>
    <div class="form-group">
        <label>Message:</label>
        <?=Html::textArea('','',['rows'=>6,'class'=>'form-control message-class']);?>
   </div>
</div>
<?=Html::hiddenInput('','',['class'=>'acknowledge-order-id-class'])?>
<?=Html::button('Send', ['class' => 'btn btn-success send-acknowledge-detaills-class',]); ?>

<?php
Modal::end();

Modal::begin([
    'header' => '<h4>Schedule</h4>',
    'id'     => 'schedule-modal',
    'size'   => 'modal-lg',
]);

echo "<div id='schedule-modal-content'></div>";
Modal::end();



//pending orders popup
Modal::begin([
    'id' => 'pending-orders-modal',
    'size' => 'modal-lg',
    'header' => '<h3>Pending Orders</h3><div class="container"><div class="row pull-right">'.date('Y').'</div></div>'
]);
?>
<div id="pending-orders-modal-content">
<?php

$year = date('Y');
$month = date('m');
$monthWordShort = date('M');

$pendingOrders = [];
foreach($entertainerOrders as $order){
    $pendingOrders[$order['event_date']][] = $order;
}
$weeks = Yii::$app->Helper->weeksInMonth($month,$year);

$s = '<div class="container-flaud">';
    $s .= '<div class="panel-group">';
    foreach($weeks as $weekNum => $weekDates){
        $count = count($weekDates);
        $s .= '<div class="panel panel-primary">';
            $s .= '<div class="panel-heading">';
                $firstDate = new DateTime($weekDates[0]);
                $firstDayDate = $firstDate->format('d');
                $lastDate = new DateTime($weekDates[$count - 1]);
                $lastDayDate = $lastDate->format('d');
                $s .= $weekNum.' '.$monthWordShort.' '.$firstDayDate .' - '.$monthWordShort.' '.$lastDayDate;
                $s .= '<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>';
            $s .= '</div>';
            //$s .= $weekDates[0].' - '. $weekDates[$count - 1].' '.$monthWordShort;
            $s .= '<div class="panel-body" id="'.$weekNum.'">';
                $s .= '<div class="panel-group">';
                    foreach($weekDates as $weekDate){
                        $date = new DateTime($weekDate);
                        $day = $date->format('l').'---'.$weekDate;
                        $s .= '<div class="panel panel-info">';
                            $s .= '<div class="panel-heading">';
                                $s .= $day;
                            $s .= '</div>';
                            $s .= '<div class="panel-body">';
                                if(!empty($pendingOrders[$weekDate])) {
                                    $dayOrders = $pendingOrders[$weekDate];
                                    $count = count($dayOrders);
                                    $i = 0;
                                    $s .= '<div class="row">';
                                    foreach($dayOrders as $order) {
                                        if($count >= 4){
                                            $blockCount = 3;
                                            $col = 4;
                                        }else{
                                            $blockCount = 2;
                                            $col = 6;
                                        }
                                        if($i != 0 && $i % $blockCount == 0 ){
                                            $s .= '<div class="clearfix">';
                                            $s .= '</div>';
                                        }
                                        $s .= '<div class="col-lg-'.$col.' col-md-'.$col.'">';
                                            $s .= '<div class="col-lg-12 col-md-12">';
                                                $s .= '<div class="table-responsive">';
                                                    $s .= '<table class="table table-bordered pending-orders-table" cellspacing="0" cellpadding="0">';
                                                        $s .= '<tr class="info">';
                                                            $s .= '<th class="small">';
                                                                $s .= 'Order &numero;';
                                                            $s .= '</th>';
                                                            $s .= '<th class="small">';
                                                                $s .= 'Party Type';
                                                            $s .= '</th>';
                                                            $s .= '<th class="small">';
                                                                $s .= 'Event Time';
                                                            $s .= '</th>';
                                                            $s .= '<th class="small">';
                                                                //$s .= 'Status';
                                                                $s .= '<span style="color:red;">';
                                                                    $s .= $order['status'];
                                                                $s .= '</span>';
                                                            $s .= '</th>';
                                                        $s .= '</tr>';
                                                        $s .= '<tr style="background-color:#ffffcc !important;">';
                                                            $s .= '<td class="small" style="width:10%;">';
                                                                $s .= $order['id'];
                                                            $s .= '</td>';
                                                            $s .= '<td class="small" style="width:30%;">';
                                                                $s .= $order['party_type_name'].'('.$order['host_child_name'].')';
                                                            $s .= '</td>';
                                                            $s .= '<td class="small" style="width:30%;">';
                                                                $startTimeObj = new DateTime($order['start_time']);
                                                                $startTime = $startTimeObj->format('H:i');
                                                                $endTimeObj = new DateTime($order['end_time']);
                                                                $endTime = $endTimeObj->format('H:i');
                                                                $s .= $startTime.'-'.$endTime;
                                                            $s .= '</td>';
                                                            $s .= '<td style="width:30%;">';
                                                                $s .= Html::button('Ackowlegde', ['class' => 'btn btn-success pull-right acknowledge-order','style'=>'background-color: #11da17;border-color: #11da17;font-size: 15px;margin-top: 10px;padding: 3px !important;']);
                                                            $s .= '</td>';
                                                        $s .= '</tr>';
                                                        $s .= '<tr class="info">';
                                                            $s .='<td class="small">';
                                                                $s .= 'Payment date';
                                                            $s .= '</td>';
                                                            $s .= '<td colspan="3">';
                                                                $s .= $order['price'];
                                                            $s .= '</td>';
                                                        $s .= '</tr>';
                                                        $s .= '<tr style="background-color:#e8f9c2 !important;">';
                                                            $s .= '<td class="small" style="width:10%" colspan="5">';
                                                                $s .= 'Entertainer name - Tom Smith';
                                                            $s .= '</td>';
                                                        $s .= '</tr>';
                                                        $s .= '<tr class="info">';
                                                            $s .= '<td colspan="5" class="small" style="width:10%">';
                                                                $s .= 'Special Requests';
                                                            $s .= '</td>';
                                                        $s .= '</tr>';

                                                    $s .= '</table>';
                                                $s .= '</div>';
                                            $s .= '</div>';
                                        $s .= '</div>';
                                        $i++;
                                    }
                                    $s .= '</div>';
                                }
                            $s .= '</div>';
                        $s .= '</div>';
                    }
                $s .= '</div>';
            $s .= '</div>';
        $s .= '</div>';
    }
    $s .= '</div>';
$s .= '</div>';
echo $s;
?>
</div>

<?php
Modal::end();
?>
<?php
Modal::begin([
    'id' => 'block-modal',
    'size' => 'modal-lg',
    'header' => '<h3>Block</h3>'
]);?>
<div id="block-modal-content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        <div class="form-group">
            <?php
            echo '<label>Date</label>';
            echo DatePicker::widget([
                'name' => 'EntertainerBusySchedule[busy_date]', 
                'value' => '',
                'options' => ['placeholder' => 'Date ...','class' => 'busy-date-class'],
                'pluginOptions' => [
                    'format' => 'dd-M-yyyy',
                    'todayHighlight' => true
                ]
            ]);?>
        </div>

        <div class="form-group" style="margin-top:10px">
            <label>Whole day</label>
            <input type="checkbox" class="all-day" />
            </div>
        
        </div>
    </div>

    <div class="row time-container">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-group">
                <?=TimePicker::widget([
                            'name' => 'EntertainerBusySchedule[busy_start_time]',
                            'value' => date('H:i'),
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
                                'name' => 'EntertainerBusySchedule[busy_end_time]',
                                'value' => date('H:i', time() + 3600),
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
                <!-- <?=Html::dropdownList('','',[2=>'Blocked time',3=>'Blocked for Jolly Rex client',4=>'Blocked for extrenal client'] ,['prompt'=>'Reason','class'=>'form-control block-reason']);?> -->
                <?=Html::dropdownList('','',[4=>'Blocked for extrenal client',2 => 'Unavailable'] ,['class'=>'form-control block-reason']);?>
            </div>
            </div>
        </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
            <div class="form-group">
                <?=Html::dropdownList('','',ArrayHelper::map(EntertainerStaff::find()->where(['entertainer_id'=>$entertainerID])->all(),'id','fullName'),['prompt'=>'Entertainers...','class'=> 'form-control entertainer-staff-list-class','multiple'=>true]);?>
            </div>
        </div>
        </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
            <div class="form-group">
                <?=Html::button('Block', ['class' => 'btn btn-primary reserve-busy-schedule', 'rel' => $entertainerID]);?>
                </div>
            </div>
    </div>
            
</div>
<?php Modal::end();?>

<?php

Modal::begin([
    'id' => 'block-details-modal',
    'size' => 'modal-md',
    'header' => 'Block Details'
]);
?>
<div id="block-details-modal-content">
   
</div>
<?php
Modal::end();?>

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    Occupancy Chart 
    <?php echo ChartJs::widget([
        'type' => 'doughnut',
        'id' => 'work',
        'options' => [
            'height' => 100,
            'width' => 300,
        ],
        'data' => [
            'radius' =>  "70%",
            'labels' => ['Robert Fisher', 'John Smith', 'Alex Body'], // Your labels
            'datasets' => [
                [
                    'data' => ['35.6', '17.5', '46.9'], // Your dataset
                    'label' => '',
                    'backgroundColor' => [
                            'red',
                            'orange',
                        //'rgba(190, 124, 145, 0.8)'
                        '#FFF44F'
                    ],
                    'borderColor' =>  [
                            '#fff',
                            '#fff',
                            '#fff'
                    ],
                    'borderWidth' => 1,
                    'hoverBorderColor'=>["#999","#999","#999"],                
                ]
            ]
        ]
    ]);
    ?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        External Order Chart 
        <?php echo ChartJs::widget([
            'type' => 'doughnut',
            'id' => 'external',
            'options' => [
                'height' => 100,
                'width' => 300,
            ],
            'data' => [
                'radius' =>  "70%",
                'labels' => ['Robert Fisher', 'John Smith', 'Alex Body'], // Your labels
                'datasets' => [
                    [
                        'data' => ['35.6', '17.5', '46.9'], // Your dataset
                        'label' => '',
                        'backgroundColor' => [
                                'red',
                                'orange',
                            //'rgba(190, 124, 145, 0.8)'
                            '#FFF44F'
                        ],
                        'borderColor' =>  [
                                '#fff',
                                '#fff',
                                '#fff'
                        ],
                        'borderWidth' => 1,
                        'hoverBorderColor'=>["#999","#999","#999"],                
                    ]
                ]
            ]
        ]);
        ?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        Jolly Rex Chart 
        <?php echo ChartJs::widget([
            'type' => 'doughnut',
            'id' => 'jolly_rex',
            'options' => [
                'height' => 100,
                'width' => 300,
            ],
            'data' => [
                'radius' =>  "70%",
                'labels' => ['Robert Fisher', 'John Smith', 'Alex Body'], // Your labels
                'datasets' => [
                    [
                        'data' => ['35.6', '17.5', '46.9'], // Your dataset
                        'label' => '',
                        'backgroundColor' => [
                                'red',
                                'orange',
                            //'rgba(190, 124, 145, 0.8)'
                            '#FFF44F'
                        ],
                        'borderColor' =>  [
                                '#fff',
                                '#fff',
                                '#fff'
                        ],
                        'borderWidth' => 1,
                        'hoverBorderColor'=>["#999","#999","#999"],                
                    ]
                ]
            ]
        ]);
        ?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        Performance Chart 
        <?php echo ChartJs::widget([
            'type' => 'doughnut',
            'id' => 'performance_based_on_review',
            'options' => [
                'height' => 100,
                'width' => 300,
            ],
            'data' => [
                'radius' =>  "70%",
                'labels' => ['Robert Fisher', 'John Smith', 'Alex Body'], // Your labels
                'datasets' => [
                    [
                        'data' => ['35.6', '17.5', '46.9'], // Your dataset
                        'label' => '',
                        'backgroundColor' => [
                                'red',
                                'orange',
                            //'rgba(190, 124, 145, 0.8)'
                            '#FFF44F'
                        ],
                        'borderColor' =>  [
                                '#fff',
                                '#fff',
                                '#fff'
                        ],
                        'borderWidth' => 1,
                        'hoverBorderColor'=>["#999","#999","#999"],                
                    ]
                ]
            ]
        ]);
        ?>
    </div>
</div>


<?php

Modal::begin([
    'id' => 'unblock-details-modal',
    'size' => 'modal-md',
    'header' => '<strong>Unavailable time</strong>',
]);
?>
<div id="unblock-details-modal-content">
    
</div>
<?php
Modal::end();?>