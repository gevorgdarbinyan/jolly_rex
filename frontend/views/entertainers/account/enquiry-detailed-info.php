<?php
use yii\web\View;
use yii\helpers\ArrayHelper;
use common\models\entertainer\EntertainerOrders;
$partyType = ArrayHelper::map($partyTypeData,'id','name');

// $this->registerCssFile("@web/css/entertainers/account/enquiry-detailed-info.css");
$this->registerJsFile('@web/js/entertainer/account/enquiry-detailed-info.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
?>
<style>
    .wrapper {
        align-items: stretch;
        background-color: #FFFFFF;
        border-radius: 20px;
        margin: 50px;
        padding: 50px 20px 20px 20px;
}
</style>
<div class="container-fluid">
    <div class="wrapper">
        <h2 class="text-center">Enquiry for <?=$partyType[$entertainerEnquiry['party_type_id']] . '('.$entertainerEnquiry['host_child_name']. ')';?></h2>
        <div class="row">
            <?php
            $option1Date = $entertainerEnquiry['option1_date'];
            $option1StartTime = $entertainerEnquiry['option1_start_time'];
            $option1EndTime = $entertainerEnquiry['option1_end_time'];

            $option2Date = $entertainerEnquiry['option2_date'];
            $option2StartTime = $entertainerEnquiry['option2_start_time'];
            $option2EndTime = $entertainerEnquiry['option2_end_time'];

            $option3Date = $entertainerEnquiry['option3_date'];
            $option3StartTime= $entertainerEnquiry['option3_start_time'];
            $option3EndTime = $entertainerEnquiry['option3_end_time'];

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

            $status = $entertainerEnquiry['status'];

            ?>
            <div class="col-lg-6 col-md-6">
                <h4>Enquiry details</h4>
                <table class="table table-bordered pending-orders-table" cellspacing="0" cellpadding="0">
                    <tr style="background-color:#e1fbd8 !important;">
                        <th class="small">
                            Enquiry &numero; : <?=$entertainerEnquiry['id'];?>
                            <input type="hidden" class="entertainer-enquiry-id-class" value="<?=$entertainerEnquiry['id'];?>" />
                        </th>
                        <th class="small">
                            <?=$partyType[$entertainerEnquiry['party_type_id']] . '('.$entertainerEnquiry['host_child_name']. ')';?>
                        </th>
                        <th class="small">
                            <span style="color:red;">
                                <?php
                                    $statusString = '';
                                    if($entertainerEnquiry['status'] == 'to_confirm') {
                                        $statusString = 'To confirm';
                                    }elseif($entertainerEnquiry['status'] == 'confirmed') {
                                        $statusString = 'Confirmed';
                                    }else{
                                        $statusString = 'Being discussed';
                                    }
                                    echo $statusString;
                                ?>
                            </span>
                        </th>
                    </tr>
                    <?php if($status === 'confirmed') :?>
                    <?php 
                        $entertainerOrder = EntertainerOrders::find()->where(['order_id' =>$entertainerEnquiry['order_id']])->one();
                        $eventDateObj = new DateTime($entertainerOrder['event_date']);
                        $newEventDate = $eventDateObj->format('l, F d, Y');
                        $startTimeObj = new DateTime($entertainerOrder['start_time']);
                        $newStartTime = $startTimeObj->format('H:i');
                        $endTimeObj = new DateTime($entertainerOrder['end_time']);
                        $newEndTime = $endTimeObj->format('H:i');
                    ?>
                    <tr>
                        <td colspan="3"><?=$newEventDate .', ' . $newStartTime . ' - ' .  $newEndTime;?></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <textarea cols="30" rows="7" class="form-control notification-message-class" placeholder="Notification message to customer...">
                            </textarea>
                        </td>
                    </tr>
                    <tr style="background-color:#ffffcc !important;">
                        <td colspan="3">
                            <button class="btn btn-success send-notification-btn-class">Send</button>
                        </td>
                    </tr>
                    <?php elseif($status === 'being_discussed') : ?>
                        <?php 
                            $entertainerOrder = EntertainerOrders::find()->where(['order_id' =>$entertainerEnquiry['order_id']])->one();
                            $eventDateObj = new DateTime($entertainerOrder['event_date']);
                            $newEventDate = $eventDateObj->format('l, F d, Y');
                            $startTimeObj = new DateTime($entertainerOrder['start_time']);
                            $newStartTime = $startTimeObj->format('H:i');
                            $endTimeObj = new DateTime($entertainerOrder['end_time']);
                            $newEndTime = $endTimeObj->format('H:i');
                        ?>
                        <tr>
                            <td colspan="3">
                                <textarea cols="30" rows="7" class="form-control notification-message-class" placeholder="Notification message to customer...">
                                </textarea>
                            </td>
                        </tr>
                        <tr style="background-color:#ffffcc !important;">
                            <td colspan="3">
                                <button class="btn btn-success send-notification-btn-class">Send</button>
                            </td>
                        </tr>
                    <?php else:?>
                        <tr class="info">
                            <th class="small" colspan="3">
                                Please choose the final date/time for event.
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2"><?=$newOption1Date .', ' . $newOption1StartTime . ' - ' .  $newOption1EndTime;?></td>
                            <td>
                                <input type="radio" name="event_date" class="option-date-radio-class" data-date="<?=$option1Date?>" data-start-time="<?=$option1StartTime;?>" data-end-time="<?=$option1EndTime;?>" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><?=$newOption2Date .', ' . $newOption2StartTime . ' - '  .  $newOption2EndTime;?></td>
                            <td><input type="radio" name="event_date" class="option-date-radio-class" data-date="<?=$option2Date?>" data-start-time="<?=$option2StartTime;?>" data-end-time="<?=$option2EndTime;?>" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?=$newOption3Date .', ' . $newOption2StartTime . ' - '  .  $newOption2EndTime;?></td>
                            <td><input type="radio" name="event_date" class="option-date-radio-class" data-date="<?=$option3Date?>" data-start-time="<?=$option3StartTime;?>" data-end-time="<?=$option3EndTime;?>" /></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Another date
                            </td>
                            <td><input type="radio" name="event_date" class="option-date-radio-class" value="other" /></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <textarea cols="30" rows="7" class="form-control enquiry-comment-class" placeholder="Please  write down all possible dates and times you are available for event..." style="display:none;">
                                Hi,
                                It is not convenient for us selected date times both.
                                Our entertainers are busy all these date times.
                                Let us share all convenient dates for us:
                                May 20, 2019, 17 : 30 - 18:30
                                May 22, 2019, 16 : 00 - 18: 30
                                June 05, 2019, at 16:30 - 18:30

                                Regards,
                                Entertainer 2 Team
                                </textarea>
                            </td>
                        </tr>
                        <tr style="background-color:#ffffcc !important;">
                            <td colspan="3">
                                <button class="btn btn-success enquiry-choose-date-time-option-btn-class">Choose the date</button>
                            </td>
                        </tr>
                    <?php endif;?>
                </table>
            </div>
            <div class="col-lg-6 col-md-6">
            <h4>Survey questions</h4>
                <table class="table table-striped" cellspacing="0" cellpadding="0">
                    <tr>
                        <th>Party Type</th>
                        <td><?=$partyType[$entertainerEnquiry['party_type_id']];?></td>
                    </tr>
                    <tr>
                        <th>Entertainers count</th>
                        <td><?=$entertainerEnquiry['entertainers_count'];?></td>
                    </tr>
                    <tr>
                        <th>Age of Host Child at the event date</th>
                        <td><?=$entertainerEnquiry['host_child_age'];?></td>
                    </tr>
                    <tr>
                        <th>Gender of Host Child</th>
                        <td><?=$entertainerEnquiry['host_child_gender'];?></td>
                    </tr>
                    <tr>
                        <th>Name of Host Child</th>
                        <td><?=$entertainerEnquiry['host_child_name']?></td>
                    </tr>
                    <tr>
                        <th>Special Requests</th>
                        <td><?=$entertainerEnquiry['special_requests'];?></td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td><?=$entertainerEnquiry['post_code'];?></td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 cl-xs-12">
                <?php if(!empty($entertainerEnquiryNotifications)): ?>
                <h3>Notifications</h3>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>Note</th>
                        </tr>
                        <?php foreach($entertainerEnquiryNotifications as $notification) : ?>
                        <tr>
                            <td><?=nl2br($notification['note']);?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <?php endif;?>
            </div>

        </div>

    </div>
</div>