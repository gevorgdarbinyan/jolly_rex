<?php
use yii\web\View;
use \yii2fullcalendar\yii2fullcalendar;
use yii\bootstrap\Modal;
use common\models\entertainer\EntertainerBusySchedule;
use frontend\components\EntertainerWidget;

//out($entertainerOrderData, true);
$eventDate = $entertainerOrderData['event_date'];
$startTime = $entertainerOrderData['start_time'];
$endTime = $entertainerOrderData['end_time'];

$eventDateObj = new DateTime($eventDate);
$newEventDate = $eventDateObj->format('l, F d, Y');
$startTimeObj = new DateTime($startTime);
$newStartTime = $startTimeObj->format('H:i');
$endTimeObj = new DateTime($endTime);
$newEndTime = $endTimeObj->format('H:i');
?>
<?php $entertainers = $entertainerOrderData['entertainers'];?>
<?php
$this->registerCssFile("@web/css/entertainers/account/order-detailed-info.css");
$this->registerJsFile('@web/js/entertainer/account/order-detailed-info.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

if (Yii::$app->user->identity) {
    $this->registerJs("
        var busyDays = JSON.parse('".$busyDays."');
    ",View::POS_HEAD);
}
?>
<div class="container-fluid">
    <div class="wrapper">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Main info</a></li>
            <li><a data-toggle="tab" href="#my-notes">My Notes</a></li>
            <li><a data-toggle="tab" href="#entertainer-staff">Manage entertainer staff</a></li>
            <li><a data-toggle="tab" href="#notifications">Notifications</a></li>
        </ul>

        <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <h2 class="text-center">Order for <?=$entertainerOrderData['party_type_name'] . '('.$entertainerOrderData['host_child_name']. ')';?></h2>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                <h4>Order details</h4>
                <table class="table table-bordered pending-orders-table" cellspacing="0" cellpadding="0">
                    <tr style="background-color:#e1fbd8 !important;">
                        <th class="small">
                            Order &numero; : <?=$entertainerOrderData['id'];?>
                        </th>
                        <th class="small">
                            <?= $entertainerOrderData['party_type_name'] . '('.$entertainerOrderData['host_child_name']. ')';?>
                        </th>
                        <th class="small">
                            <span style="color:red;">
                                <?=$entertainerOrderData['status'];?>
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
                        <?= $newEventDate . ' ' . $newStartTime . ' ' .  $newEndTime;?>
                    </td>
                    <td colspan="2">
                        <?= $entertainerOrderData['price'];?>
                    </td>
                    </tr>
                    <tr style="background-color:#e1fbd8 !important;">
                        <td class="small" style="width:10%" colspan="3">
                            <div class="row">
                                <?php foreach($entertainers as $entertainer){ ?>
                                    <?php if(in_array($entertainer['id'],$entertainerOrdersStaff)) { ?>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="checkbox">
                                                <input type="hidden" value="<?=$entertainer['id'];?>" class="entertainer-staff-member-class" />
                                                <label><?=$entertainer['first_name'].' '.$entertainer['last_name']?></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <span class="schedule-calendar-class" style="cursor:pointer;text-decoration:underline;">
                                                Personal Calendar
                                            </span>
                                        </div>
                                        <div class="clearfix"></div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                </table>

                </div>
                <div class="col-lg-6 col-md-6">
                    <h4>Survey questions</h4>
                    <table class="table table-striped" cellspacing="0" cellpadding="0">
                        <tr>
                            <th>Party Type</th>
                            <td><?=$entertainerOrderData['party_type_name'];?></td>
                        </tr>
                        <tr>
                            <th>Entertainers count</th>
                            <td><?=$entertainerOrderData['entertainers_count'];?></td>
                        </tr>
                        <tr>
                            <th>Age of Host Child at the event date</th>
                            <td><?=$entertainerOrderData['host_child_age'];?></td>
                        </tr>
                        <tr>
                            <th>Gender of Host Child</th>
                            <td><?=$entertainerOrderData['host_child_gender'];?></td>
                        </tr>
                        <tr>
                            <th>Name of Host Child</th>
                            <td><?=$entertainerOrderData['host_child_name'];?></td>
                        </tr>
                        <tr>
                            <th>Special Requests</th>
                            <td><?=$entertainerOrderData['special_requests'];?></td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td><?=$entertainerOrderData['city']. ' '.$entertainerOrderData['venue_address'];?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <?php $disabled = ($entertainerOrderData['status'] == 'Acknowledged') ? 'disabled="disabled"' : '';?>
                    <textarea class="form-control message-class" placeholder="Message to client..." <?=$disabled;?>><?=$entertainerOrderData['message'];?></textarea>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 text-center">
                    <?php if($entertainerOrderData['status'] == 'Unacknowledged') :?>
                        <button class="btn btn-success acknowledge-order" data-order-id="<?=$entertainerOrderData['id'];?>" style="background-color: #11da17;border-color: #11da17;font-size: 25px;margin-top: 10px;padding: 30px !important;">Acknowlegde</button>
                    <?php endif;?>
                    <button class="btn btn-danger cancel-order" data-order-id="<?=$entertainerOrderData['id'];?>" style="font-size: 25px;margin: 10px 0px 0px 5px;padding: 30px !important;">Cancel</button>
                </div>
            </div>
        </div>
        <div id="my-notes" class="tab-pane fade">
            <h3>My Notes</h3>
            <table class="table">
                <tr class="info">
                    <td colspan="3" class="small" style="width:10%">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <textarea class="form-control entertainer-note-class" placeholder="Make a note..." rows="7"><?=$entertainerOrderData['note'];?></textarea>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <button class="btn btn-success save-note">Save Note</button>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div id="entertainer-staff" class="tab-pane fade">
            <table class="table">
                <tr style="background-color:#e1fbd8 !important;">
                    <td class="small" style="width:10%" colspan="3">
                        <div class="row">
                            <?php foreach($entertainers as $entertainer){ ?>
                                <?php $checked = (in_array($entertainer['id'],$entertainerOrdersStaff)) ? "checked" : "";?>
                                <div class="col-lg-4 col-md-4">
                                    <div class="checkbox">
                                        <label><input type="checkbox" value="<?=$entertainer['id'];?>" class="entertainer-staff" <?=$checked;?>><?=$entertainer['first_name'].' '.$entertainer['last_name']?></label>
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
                        <div class="form-group">
                            <button class="btn btn-success pull-right update-entertainers" data-order-id="<?=$entertainerOrderData['id'];?>">Update</button>
                        </div>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="" class="order-id-class" value="<?=$entertainerOrderData['order_id'];?>" />
        </div>
        <div id="notifications" class="tab-pane fade">
            <div class="form-group">
                <textarea class="form-control message-class" cols="30" rows="7" placeholder="Message to admin or customer regarding to event..."></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success send-notification-class">Send</button>
            </div>
        </div>
        <input type="hidden" value="<?=$entertainerOrderData['id'];?>" class="entertainer-order-id-class" />
        <input type="hidden" value="<?=$entertainerOrderData['entertainer_id'];?>" class="entertainer-id-class" />
        <input type="hidden" value="<?=$entertainerOrderData['customer_id'];?>" class="customer-id-class" />
        </div>
    </div>
</div>

<?php
Modal::begin([
    'id' => 'entertainer-staff-block-modal',
    'size' => 'modal-md',
    'header' => '<h3>Calendar</h3>'
]);?>
<div id="entertainer-staff-schedule-modal-content">
<h4>Alex Body</h4>
        <?php
            $events = [];
            $lists = EntertainerBusySchedule::find()->all();
            foreach($lists as $list) {
                $event        = new \yii2fullcalendar\models\Event();
                $event->id    = $list->id;
                $event->title = EntertainerWidget::getName($list->reason);
                $event->start = $list->busy_date.'T'.$list->busy_start_time;
                $event->end = $list->busy_date.'T'.$list->busy_end_time;
                $event->color = EntertainerWidget::getColor($list->reason);
                $event->textColor = EntertainerWidget::getTextColor($list->reason);
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
                        'id' =>'schedule-calendar4',
                    ],
                    'clientOptions' => [
                        'header' => ['right' => 'month,agendaWeek,agendaDay,listMonth'],
                        'editable' => true,
                        'draggable' => true,
                        'dayClick' => new \yii\web\JsExpression('
                            function (date, jsEvent, view) {
                                var dateValue = date.format();
                                var dateExpression = new Date(dateValue);
                                var toDateString = dateExpression.toDateString();
                                var entertainerID = '.Yii::$app->user->identity->id.';

                                $("#busy-schedule-container").show();
                                $(".busy-date-label-class").html(toDateString);
                                $(".busy-date-input-class").val(dateValue);

                                var busyScheduleDateHeading = $(".busy-schedule-date-heading").html();
                                $(".date-piece-class").html(toDateString);
                                $.ajax({
                                    url: App.base_path + "entertainers/get-busy-schedule",
                                    type: "POST",
                                        data: { date: dateValue, entertainer_id:entertainerID},
                                        success: function(data) {
                                            $(".busy-schedule-date-table tbody").html(data);
                                        }
                                });
                                $(".busy-schedule-date-panel").show();
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
                    ],
            ));
            ?>
            
</div>
<?php Modal::end();?>