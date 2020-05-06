<?php
//use common\models\User;
use yii\helpers\Html;
use yii\web\View;
//use kartik\datetime\DateTimePicker;
use \yii2fullcalendar\yii2fullcalendar;
use kartik\time\TimePicker;
//use frontend\components\SlideshowWidget;
use yii\helpers\ArrayHelper;
//use common\models\PartyType;
use common\models\entertainer\EntertainerOrders;

$this->registerCssFile("@web/css/venue/page.css");
$this->registerJsFile('@web/js/venue/page.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="container-fluid">
    <div class="venue-page">
         <?php
         //if($venueData['support_instant_booking'] == 1) {
            echo $this->render('/orders/active-order-line',['order'=>$orderData]);
         //}
         ?>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <img src="/images/venueLayer.jpg" width="100%">
                <div style="margin: 20px 0px;">
                    Availibility of calendar
                    <?php
                    echo
                    yii2fullcalendar::widget(array(
                        'clientOptions' => [
                            'header' => ['right' => ''],
                            'dayClick' => new \yii\web\JsExpression('
                                function (date, jsEvent, view) {
                                    var dateValue = date.format();
                                    var dateExpression = new Date(dateValue);
                                    var toDateString = dateExpression.toDateString();
                                    $(this).css("background-color", "red");
                                    $(".selected-date").html(toDateString);
                                    $(".selected-date-class").val(dateValue);
                                    $("#time-container").show();
                                    var entertainerID = '.$venueID.';
                                    $("#modal-schedule-content").modal("show");
                                    /*$.ajax({
                                        url: App.base_path + "entertainers/get-busy-schedule",
                                        type: "POST",
                                            data: { date: dateValue, entertainer_id:entertainerID},
                                            success: function(data) {
                                                $(".busy-schedule-table tbody").html(data);
                                            }
                                    });*/
                                    
                                }'
                            ),
                            'dayRender' => new \yii\web\JsExpression('
                                function (date, cell) {
                                    var check = $.fullCalendar.formatDate(date,"YYYY-MM-DD");
                                    //console.log(check);
                                    if (moment().diff(date,"days") > 0){
                                        //cell.css("background-color","red");
                                    }else{
                                        //cell.css("background-color", "green");
                                    }
                                }'
                            ),
                        ],
                    ));
                    ?>
                </div>
                <div class="well" id="date-time-container">
                    <p>
                        <label style="color: #1c1c92;font-size:16px;">Event Date: </label><span class="selected-date"></span>
                        <?= Html::hiddenInput('venue_id', $orderData->id, ['class' => 'order-id-class']); ?>
                        <?= Html::hiddenInput('venue_id', $venueID, ['class' => 'venue-id-class']); ?>
                        <?= Html::hiddenInput('support_instant_booking', $venueData['support_instant_booking'], ['class' => 'support-instant-booking-class']); ?>
                        <?= Html::hiddenInput('selected_date', '', ['class' => 'selected-date-class']); ?>
                    </p>
                    <p>
                        <label style="color: #1c1c92;font-size:16px;">Event Time:</label>
                        <span id="event-time"></span> <br />
                        <input type="hidden" name="start_time" class="start-time-class" value="" />
                        <input type="hidden" name="end_time" class="end-time-class" value="" />
                    </p>
                    <p>
                        <label style="color: #1c1c92;font-size:16px;">Duration:</label>
                        <span id="duration"></span>
                        <input type="hidden" name="hours" class="hours-class" value="" />
                        <input type="hidden" name="minutes" class="minutes-class" value="" />
                    </p>
                </div>
                <div class="form-group">
                    <?=Html::dropDownList('','',ArrayHelper::map($venueOptionsData,'name','name'),['class'=>'form-control venue-rooms','prompt'=>'Select a room...'])?>
                </div>
                <div>
                    <p>
                        <label style="font-size:20px;">Total: </label> £ <span id="total-price"></span>
                        <input type="hidden" name="total" class="total-class" value="" />
                    </p>
                </div>
                <div>
                    <?php echo Html::button('Reserve', ['class' => 'btn btn-success reserve-venue','style'=>'color: #fff;background-color: #11bb11;']);?>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?=$this->render('_main_info',['venueData'=>$venueData]);?>
                    <?=$this->render('_gallery',['venueData'=>$venueData]);?>
                    <?=$this->render('_description',['venueData'=>$venueData]);?>
                    <?php //$this->render('_venue_options',['venueOptionsData'=>$venueOptionsData]);?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h4>Schedule</h4>',
    'id' => 'modal-schedule-content',
    'size' => 'modal-lg'
]);

$str = "<div id='modal-schedule-container'>";
$str .= Html::beginTag('div', ['class'=>'modal-body']);
$str .= Html::beginTag('div',['class'=>'panel panel-warning']);
    $str .= Html::beginTag('div',['class'=>'panel-heading']);
        $str .= 'Choose Your Time Now';
    $str .= Html::endTag('div');
    $str .= Html::beginTag('div',['class'=>'panel-body']);
        $str .= Html::beginTag('table',['class'=>'table table-bordered']);
            $str .= Html::beginTag('tr');
                $str .= Html::beginTag('th');
                    $str .= 'Start';
                $str .= Html::endTag('th');
                $str .= Html::beginTag('th');
                    $str .= 'End';
                $str .= Html::endTag('th');
            $str .= Html::endTag('tr');
            
            $str .= Html::beginTag('tr');
                $str .= Html::beginTag('td');
                    $str .= TimePicker::widget([
                        'name' => 'start_time',
                        'value' => date('H:i'),
                        'pluginOptions' => [
                            'showSeconds' => false,
                            'showMeridian' => false,
                        ],
                        'options' => [
                            'class' => 'start-time'
                        ],
                    ]);
                $str .= Html::endTag('td');
                $str .= Html::beginTag('td');
                   $str .= TimePicker::widget([
                        'name' => 'end_time',
                        'value' => date('H:i', time()+3600),
                        'pluginOptions' => [
                            'showSeconds' => false,
                            'showMeridian' => false,
                        ],
                        'options' => [
                            'class' => 'end-time'
                        ],
                    ]);
                $str .= Html::endTag('td');
            $str .= Html::endTag('tr');
            $str .= Html::beginTag('tr');
                $str .= Html::beginTag('td',['colspan'=>'2']);
                    $str .= Html::beginTag('div', ['class'=>'validation-message-container']);
                    //@TODO put validation message if selected time is not available or there is lack of entertainers
                    $str .= Html::endTag('div');
                $str .= Html::endTag('td');
            $str .= Html::endTag('tr');
        $str .= Html::endTag('table');
        
        $str .= Html::beginTag('div', ['class'=>'cols-lg-6 cols-md-6 cols-sm-6 cols-xs-12']);
            $str .= Html::beginTag('div', ['class'=>'form-group']);
                $str .= Html::button('Choose',['class'=>'btn btn-primary choose-date-class']);
            $str .= Html::endTag('div');
        $str .= Html::endTag('div');

    $str .= Html::endTag('div');
$str .= Html::endTag('div');

$str .= Html::beginTag('div',['class'=>'panel panel-danger']);
    $str .= Html::beginTag('div',['class'=>'panel-heading']);
        $str .= 'No Venues Available at This Time';
    $str .= Html::endTag('div');
    $str .= Html::beginTag('div',['class'=>'panel-body']);
        $str .= Html::beginTag('table',['class'=>'table table-borderedless busy-schedule-table']);
            $str .= Html::beginTag('tbody');
                
            $str .= Html::endTag('tbody');
        $str .= Html::endTag('table');
    $str .= Html::endTag('div');
$str .= Html::endTag('div');
$str .= Html::endTag('div');
$str .= "</div>";



echo $str;
\yii\bootstrap\Modal::end();
?>