<?php
namespace frontend\components;
use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use common\models\entertainer\EntertainerStaff;
use yii\helpers\Html;

class EntertainerScheduleWidget extends Widget {
    public $content;
    public $entertainerID;
    public $year;
    public $month;
    public $week = '';
    public $day = '';
    public $type = '';
    public $entertainer = '';

    public function init() {
        parent::init();
        $this->content = $this->getSchedule($this->entertainerID,$this->year, $this->month, $this->week ,$this->day, $this->type, $this->entertainer);
        return $this->content;
    }

    public function run() {
        return $this->content;
    }

    public function getSchedule($entertainerID, $year, $month, $week, $d, $type, $entertainer) {
        $entertainerStaffCondition = (!empty($entertainer)) ? 'AND tbl_entertainer_orders_staff.entertainer_staff_id IN('.implode(',', $entertainer).')' : '';

        $entertainerStaff = EntertainerStaff::find()->where(['entertainer_id'=>$entertainerID])->all();
        $entertainerStaffList = ArrayHelper::map($entertainerStaff,'id','fullNameAbbr');

        $query = "
            SELECT 
                tbl_entertainer_busy_schedule.id,
                tbl_entertainer_busy_schedule.entertainer_id,
                tbl_entertainer_busy_schedule.busy_date,
                tbl_entertainer_busy_schedule.busy_start_time,
                tbl_entertainer_busy_schedule.busy_end_time,
                tbl_entertainer_busy_schedule.reason,
                tbl_entertainer_busy_schedule.note,
                tbl_entertainer_busy_schedule_staff.entertainer_staff_id,
                tbl_entertainer_staff.first_name,
                tbl_entertainer_staff.last_name
            FROM tbl_entertainer_busy_schedule
            JOIN tbl_entertainer_busy_schedule_staff 
                ON tbl_entertainer_busy_schedule.id = tbl_entertainer_busy_schedule_staff.busy_schedule_id
            JOIN tbl_entertainer_staff ON tbl_entertainer_busy_schedule_staff.entertainer_staff_id = tbl_entertainer_staff.id
            WHERE tbl_entertainer_busy_schedule.entertainer_id=".$entertainerID." AND tbl_entertainer_busy_schedule.order_id = 0
            ORDER BY tbl_entertainer_busy_schedule.busy_date, tbl_entertainer_busy_schedule.busy_start_time,tbl_entertainer_busy_schedule.busy_end_time, tbl_entertainer_busy_schedule.id
        ";
        $busySchedule = Yii::$app->db->createCommand($query)->queryAll();
        $busyScheduleData = [];
        foreach($busySchedule as $schedule) {
            $busyScheduleData[$schedule['busy_date']][] = $schedule;
        }
        $query = "
            SELECT
                tbl_entertainer_orders.id,
                tbl_entertainer_orders.status,
                tbl_entertainer_orders.info_status,
                tbl_entertainer_orders.order_id,
                tbl_entertainer_orders.entertainer_id,
                tbl_entertainer_orders.event_date,
                tbl_entertainer_orders.start_time,
                tbl_entertainer_orders.end_time,
                tbl_entertainer_orders.note,
                tbl_entertainer_orders_staff.entertainer_staff_id,
                tbl_entertainer_staff.first_name,
                tbl_entertainer_staff.last_name
            FROM tbl_entertainer_orders
            LEFT JOIN tbl_entertainer_orders_staff ON tbl_entertainer_orders.id = tbl_entertainer_orders_staff.entertainer_order_id
            LEFT JOIN tbl_entertainer_staff ON tbl_entertainer_orders_staff.entertainer_staff_id = tbl_entertainer_staff.id
            WHERE tbl_entertainer_orders.entertainer_id = ".$entertainerID." ".$entertainerStaffCondition."
            ORDER BY tbl_entertainer_orders.event_date, tbl_entertainer_orders.start_time,tbl_entertainer_orders.end_time, tbl_entertainer_orders.id
        ";
        $entOrders = Yii::$app->db->createCommand($query)->queryAll();

        $eOrders = [];
        foreach($entOrders as $entOrder) {
            $eOrders[$entOrder['event_date']][] = $entOrder;
        }
        $today = date('Y-m-d');
        $year = date('Y');
        $month = ($month) ? $month :date('m');
        $weeks = Yii::$app->Helper->weeksInMonth($month,$year);
        if(!empty($week)) {
            if(isset($weeks[$week])){
                $weeks = [$week => $weeks[$week]];
            }
        }
        //dump($d);
        //out($weeks);die;
        $str = '';
        foreach($weeks as $weekNum => $weekDates){
            //dump(in_array($today, $weekDates));
            $collapsed = (!in_array($today, $weekDates)) ? 'panel-collapsed': '';
            $display = (!in_array($today, $weekDates)) ? 'display:none;': '';
            $glyphiconChevron = (!in_array($today, $weekDates)) ? 'glyphicon-chevron-down': 'glyphicon-chevron-up';
            $count = count($weekDates);
            $str .= '<div class="panel panel-primary">';
                $str .= '<div class="panel-heading" style="background-color:#4da954 !important;">';
                    $monthObject = new \DateTime($weekDates[0]);
                    $monthWordShort = $monthObject->format('M');
                    $firstDate = new \DateTime($weekDates[0]);
                    $firstDayDate = $firstDate->format('d');
                    $lastDate = new \DateTime($weekDates[$count - 1]);
                    $lastDayDate = $lastDate->format('d');
                    $str .= $weekNum.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$monthWordShort.' '.$firstDayDate .' - '.$monthWordShort.' '.$lastDayDate;
                    $str .= '<span class="pull-right clickable '.$collapsed.'"><i class="glyphicon '.$glyphiconChevron.'"></i></span>';
                $str .= '</div>';
                $str .= '<div class="panel-body" id="<?=$weekNum?>" style="padding:0;border:0px;height:450px;overflow-y:auto;'.$display.'">';
                    $str .= '<div class="panel-group">';
                        foreach($weekDates as $weekDate){
                            $date = new \DateTime($weekDate);
                            $day = $date->format('l, F d, Y');
                            if($d && $d > 0 && $d != $weekDate) continue;
                            $str .= '<div class="panel panel-info">';
                                $str .= '<div class="panel-heading" style="background-color:#ccffcc !important;">';
                                    $str .= $day;
                                    $str .= '<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>';
                                $str .= '</div>';
                                $str .= '<div class="panel-body">';
                                    if(!empty($busyScheduleData[$weekDate]) || !empty($eOrders[$weekDate])) {
                                        $str .= '<div class="pull-right">';
                                            $str .= '<div class="form-group">';
                                                $str .= Html::hiddenInput('',$weekDate,['class'=>'current-date-class']);
                                            $str .= '</div>';
                                        $str .= '</div>';
                                        $str .= '<table class="table table-bordered busy-schedule-table">';
                                            $str .= '<tbody>';
                                                $str .= '<tr>';
                                                    $str .= '<td style="font-size: 18px;font-weight:bold;">';
                                                        $str .= 'Start Time';
                                                    $str .= '</td>';
                                                    $str .= '<td style="font-size: 18px;font-weight:bold;">';
                                                        $str .= 'End Time';
                                                    $str .= '</td>';
                                                    $str .= '<td style="font-size: 18px;font-weight:bold;">';
                                                        $str .= 'Category';
                                                    $str .= '</td>';
                                                    $str .= '<td style="font-size: 18px;font-weight:bold;">';
                                                        $str .= 'Entertainer(s)';
                                                    $str .= '</td>';
                                                    for($i = 8; $i < 22; $i++) {
                                                        $str .= '<td colspan="4" class="text-center hours">'.$i.'</td>';
                                                    }
                                                $str .= '</tr>';
                                    }
                                    if(!empty($busyScheduleData[$weekDate])) {
                                        $busySchedule = $busyScheduleData[$weekDate];
                                        $count = count($busySchedule);
                                        $wholeDayEntertainers = [];
                                        $unavailableTimeRows = [];
                                        $externalOrderTimeRows = [];
                                        foreach($busySchedule as $schedule) {
                                            $startTimeObj = new \DateTime($schedule['busy_start_time']);
                                            $startTime = $startTimeObj->format('H:i');

                                            $endTimeObj = new \DateTime($schedule['busy_end_time']);
                                            $endTime = $endTimeObj->format('H:i');
                                            if($schedule['reason'] == 4){
                                                $str .= '<tr>';
                                                    if($schedule['busy_start_time'] != '' && $schedule['busy_end_time'] != ''){
                                                        $str .= '<td>';
                                                            $str .= $startTime;
                                                            $str .= '<input type="hidden" class="busy-schedule-id" value="'.$schedule['id'].'"/>';
                                                        $str .= '</td>';
                                                        $str .= '<td>';
                                                            $str .= $endTime;
                                                        $str .= '</td>';
                                                    }else{ 
                                                        $str .= '<td colspan="2">';
                                                            $str .= 'Whole day';
                                                        $str .= '</td>';
                                                    }
                                                    $str .= '<td>';
                                                    $str .= '<span class="block-details" data-busy-schedule-id="'.$schedule['id'].'" style="cursor:pointer;color:#337ab7;font-size: 10.5px;">';
                                                        $str .= EntertainerWidget::getName($schedule['reason']);
                                                        $str .= '</span>';
                                                    $str .= '</td>';
                                                    $str .= '<td>';
                                                        $str .= $schedule['first_name'][0].'.'.$schedule['last_name'][0].'.';
                                                    $str .= '</td>';
                                                    $str .= $this->drawBusyScheduleHourColumns($schedule);
                                                    $str .= '</tr>';
                                            }elseif($schedule['reason'] == 2){
                                                if(!empty($schedule['busy_start_time']) && !empty($schedule['busy_end_time'])){
                                                    $unavailableTimeRows[$schedule['entertainer_staff_id']][] = $startTime.'-'.$endTime;
                                                }else{
                                                    $wholeDayEntertainers[] = $schedule['entertainer_staff_id'];
                                                }
                                            }
                                        } 
                                        $wholeDayEntertainers = array_unique($wholeDayEntertainers);
                                        $wholeDayEntertainersNames = array_map(function($item){
                                            $entertainerStaff = EntertainerStaff::findOne($item);
                                            return $entertainerStaff['first_name'][0].'.'.$entertainerStaff['last_name'][0].'.';
                                        },$wholeDayEntertainers);
                                        $wholeDayEntertainersString = implode(',', $wholeDayEntertainersNames);
                                        if(!empty($wholeDayEntertainers)){
                                            $str .= '<tr>';
                                                $str .= '<td colspan="2">Whole day</td>';
                                                $str .= '<td>Unavailable</td>';
                                                $str .= '<td>'.$wholeDayEntertainersString.'</td>';
                                                
                                                for($i = 8; $i < 22; $i++) {
                                                        for($j = 0; $j <= 45; $j+=15) {
                                                            if($j == 0 ){
                                                                $str .= '<td title="'.$i.':00" bgcolor="#ff4d4d"></td>';
                                                            } else {
                                                                $str .= '<td title="'.$i.':'.$j.'" bgcolor="#ff4d4d"></td>';
                                                            }
                                                        }
                                                }
                                            $str .= '</tr>';
                                        }
                                    
                                        if(!empty($unavailableTimeRows)) {
                                            $countRows = count($unavailableTimeRows);
                                            $j = 0;
                                            foreach($unavailableTimeRows as $staffID => $scheduleItem) {
                                                $entertainerStaff = EntertainerStaff::findOne($staffID);
                                                
                                                $str .= '<tr>';
                                                    if($j < 1){
                                                        $str .= '<td colspan="3" rowspan="'.$countRows.'">';
                                                        $str .= '<span class ="view-blocked-schedule" data-staff-id="'.$staffID.'" style="cursor:pointer;color:#3c763d;font-size:10px;">';
                                                        $str .= 'View Schedule';
                                                        $str .= '</span>';
                                                        $str .= '&nbsp;';
                                                        $str .= 'Unavailable';
                                                        $str .= '</td>';
                                                    }
                                                    $str .= '<td>'.$entertainerStaff['first_name'][0].'.'.$entertainerStaff['last_name'][0].'.</td>';
                                                    $str .= $this->drawUnavailableTimeRows($scheduleItem);
                                                $str .= '</tr>';
                                                $j++;
                                            }
                                        }
                                    }

                                    if(!empty($eOrders[$weekDate])) {
                                        $orders = $eOrders[$weekDate];
                                        $count = count($orders);
                                        foreach($orders as $order) {
                                            $entertainerStaff = EntertainerStaff::findOne($order['entertainer_staff_id']);
                                            $startTimeObj = new \DateTime($order['start_time']);
                                            $startTime = $startTimeObj->format('H:i');

                                            $endTimeObj = new \DateTime($order['end_time']);
                                            $endTime = $endTimeObj->format('H:i');

                                            $startTimeSplitted = explode(':',$startTime);
                                            $endTimeSplitted = explode(':',$endTime);
                                            $startHour = $startTimeSplitted[0];
                                            $startMin = $startTimeSplitted[1];

                                            $endHour = $endTimeSplitted[0];
                                            $endMin = $endTimeSplitted[1];
                                            $color = ($order['info_status'] === 'Unacknowledged') ? '#FCE205': '#0f52ba';
                                            $str .= '<tr>';
                                                $str .= '<td>';
                                                    $str .= $startTime;
                                                    $str .= '<input type="hidden" class="busy-schedule-id" value="'.$order['id'].'"/>';
                                                $str .= '</td>';
                                                $str .= '<td>';
                                                    $str .= $endTime;
                                                $str .= '</td>';
                                                $str .= '<td>';
                                                    $str .= '<a href="entertainers/entertainer-order-detailed-info?id='.$order['order_id'].'" target="_blank" style="cursor:pointer;color:#337ab7;font-size: 10.5px;">Jolly Rex order &numero;'.$order['id'].'</a><br />'.$order['info_status'];
                                                $str .= '</td>';
                                                $str .= '<td>'.$entertainerStaff['first_name'][0].'. '.$entertainerStaff['last_name'][0].'.</td>';
                                                for($i = 8; $i < 22; $i++) {
                                                    for($j = 0; $j <= 45; $j+=15) {
                                                        if($j == 0 ){
                                                            $bgColorString = 'bgcolor="#e1fbd8"';
                                                            if( $i >= intval($startHour) && $i <= intval($endHour) ){
                                                                if($i == intval($startHour) ){
                                                                    if($j >= intval($startMin)) {
                                                                        $bgColorString = 'bgcolor="'.$color.'"';
                                                                    }
                                                                }elseif($i == intval($endHour)) {
                                                                    if($endMin != 0){
                                                                        if($j <= intval($endMin) ){
                                                                            $bgColorString = 'bgcolor="'.$color.'"';
                                                                        }
                                                                    }else {
                                                                        
                                                                    }
                                                                }elseif($i > intval($startHour) && $i < intval($endHour)){
                                                                    $bgColorString = 'bgcolor="'.$color.'"';
                                                                }
                                                            }
                                                            $str .= '<td title="'.$i.':00"  '.$bgColorString.'></td>';
                                                        } else {
                                                            $bgColorString = 'bgcolor="#e1fbd8"';
                                                            if( $i >= intval($startHour) && $i <= intval($endHour) ){
                                                                    if($i == intval($startHour) ){
                                                                        if($j >= intval($startMin)) {
                                                                            $bgColorString = 'bgcolor="'.$color.'"';
                                                                        }
                                                                    }elseif($i == intval($endHour)) {
                                                                        if($j < intval($endMin)){
                                                                            $bgColorString = 'bgcolor="'.$color.'"';
                                                                        }
                                                                    }elseif($i > intval($startHour) && $i < intval($endHour)){
                                                                        $bgColorString = 'bgcolor="'.$color.'"';
                                                                    }
                                                                }
                                                                $str .= '<td title="'.$i.':'.$j.'" '.$bgColorString.'></td>';
                                                        }
                                                    }
                                                }
                                            $str .= '</tr>';
                                    }
                                }
                                if(!empty($busyScheduleData[$weekDate]) || !empty($eOrders[$weekDate])){
                                    $str .= '</table>';
                                    $str .= '<div id="seperate-container"></div>';
                                }
                                $str .= '</div>';
                            $str .= '</div>';
                        }
                    $str .= '</div>';
                $str .= '</div>';
            $str .= '</div>';
        }
        return $str;
    }

    function drawUnavailableTimeRows($scheduleItem, $reason = 2){
        if($reason == 2){
            $color = '#ff4d4d';
        }else{
            $color = '';
        }
        $str = '';
        for($i = 8; $i < 22; $i++) {
            for($j = 0; $j <= 45; $j+=15) {
                $minute = ($j == 0) ? "00": $j;
                $flag = 0;
                foreach($scheduleItem as $time) {
                    $timeSplitted = explode('-', $time);
                    $startTime = $timeSplitted[0];
                    $endTime = $timeSplitted[1];
                    $startTimeSplitted = explode(':',$startTime);
                    $endTimeSplitted = explode(':',$endTime);
                    $startHour = $startTimeSplitted[0];
                    $startMin = $startTimeSplitted[1];
    
                    $endHour = $endTimeSplitted[0];
                    $endMin = $endTimeSplitted[1];
                    if( $i >= intval($startHour) && $i <= intval($endHour) ){
                        if($i == intval($startHour) ){
                            if($j >= intval($startMin)) {
                                $flag = 1;
                            }
                        }elseif($i == intval($endHour)) {
                            if($endMin != 0){
                                if($j < intval($endMin) ){
                                    $flag = 1;
                                }
                            }
                        }elseif($i > intval($startHour) && $i < intval($endHour)){
                            $flag = 1;
                        }
                    }
                }
                $bgColorString = ($flag == 1) ? 'bgcolor="'.$color.'"' : 'bgcolor="#e1fbd8"';
                $str .= '<td title="'.$i.':'.$minute.'" '.$bgColorString.'></td>';
            }
        }
        return $str;
    }

    function drawBusyScheduleHourColumns($schedule){
        $startTimeObj = new \DateTime($schedule['busy_start_time']);
        $startTime = $startTimeObj->format('H:i');
    
        $endTimeObj = new \DateTime($schedule['busy_end_time']);
        $endTime = $endTimeObj->format('H:i');
    
        $startTimeSplitted = explode(':',$startTime);
        $endTimeSplitted = explode(':',$endTime);
        $startHour = $startTimeSplitted[0];
        $startMin = $startTimeSplitted[1];
    
        $endHour = $endTimeSplitted[0];
        $endMin = $endTimeSplitted[1];
        $color = '';
        if($schedule['reason'] == 2){
            $color = '#ff4d4d';
        }elseif($schedule['reason'] == 4){
            $color = '#E3B778';
        }
        $str = '';
        for($i = 8; $i < 22; $i++) { 
            for($j = 0; $j <= 45; $j+=15) {
                if($j == 0 ){
                    if(empty($schedule['busy_start_time']) && empty($schedule['busy_end_time'])){
                        $str .= '<td bgcolor="#ff4d4d"></td>';
                    }else{
                        $bgColorString = 'bgcolor="#e1fbd8"';
                        if( $i >= intval($startHour) && $i <= intval($endHour) ){
                            if($i == intval($startHour) ){
                                if($j >= intval($startMin)) {
                                    $bgColorString = 'bgcolor="'.$color.'"';
                                }
                            }elseif($i == intval($endHour)) {
                                if($endMin != 0){
                                    if($j <= intval($endMin) ){
                                        $bgColorString = 'bgcolor="'.$color.'"';
                                    }
                                }else {
                                    
                                }
                            }elseif($i > intval($startHour) && $i < intval($endHour)){
                                $bgColorString = 'bgcolor="'.$color.'"';
                            }
                        }
                        $str .= '<td title="'.$i.':00"  '.$bgColorString.'></td>';
                    } 
                    } else { 
                        if(empty($schedule['busy_start_time']) && empty($schedule['busy_end_time'])){
                            $str .= '<td bgcolor="#ff4d4d"></td>';
                        }else{
                            $bgColorString = 'bgcolor="#e1fbd8"';
                            if( $i >= intval($startHour) && $i <= intval($endHour) ){
                                if($i == intval($startHour) ){
                                    if($j >= intval($startMin)) {
                                        $bgColorString = 'bgcolor="'.$color.'"';
                                    }
                                }elseif($i == intval($endHour)) {
                                    if($j < intval($endMin)){
                                        $bgColorString = 'bgcolor="'.$color.'"';
                                    }
                                }elseif($i > intval($startHour) && $i < intval($endHour)){
                                    $bgColorString = 'bgcolor="'.$color.'"';
                                }
                            } 
                            $str .= '<td title="'.$i.':'.$j.'" '.$bgColorString.'></td>';
                        }
                }
            }
         }
        return $str;
    }
}