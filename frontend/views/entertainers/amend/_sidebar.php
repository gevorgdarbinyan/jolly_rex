<?php
use \yii2fullcalendar\yii2fullcalendar;
use yii\helpers\Html;
use kartik\time\TimePicker;
use yii\helpers\ArrayHelper;
use common\models\PartyType;
use common\models\PartyTheme;
use common\models\entertainer\EntertainerServices;
use common\models\entertainer\EntertainerOrderPrices;
use common\models\entertainer\EntertainerPackages;

?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="text-align-center">
        <?= Html::img('@web/images/Layer.jpg', ['class' => 'img-circle']); ?>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
        <div style="margin-bottom: 20px;">
            Availibility of calendar
            <span class="btn btn-link detailed-info">Detailed info</span>
            <!-- <div id="calendar"></div> -->
            <?php if(!empty($orderData)) {
                ?>
                <input type="hidden" value="<?=$orderData['id']; ?>" class="order-id-class" />
                <?php
            }?>
            <?php
            echo yii2fullcalendar::widget(array(
                //'events' => $events,
                //'id' => 'calendar',
                'clientOptions' => [
                    //'defaultView' =>'timelineDay',
                    'header' => ['right' => ''],
                    'dayClick' => new \yii\web\JsExpression('
                        function (date, jsEvent, view) {
                            var dateValue = date.format();
                            
                            var dateExpression = new Date(dateValue);
                            var toDateString = dateExpression.toDateString();


                            //console.log(typeof dateValue);
                            //console.log("Clicked on: " + date.format());
                            // console.log("Coordinates: " + jsEvent.pageX + "," + jsEvent.pageY);
                            // console.log("Current view: " + view.name);

                            $(this).css("background-color", "red");
                            $(".fc-day").not($(this)).not(".fc-today").css("background-color", "white");
                            $(".selected-date").html(toDateString);
                            $(".selected-date-class").val(dateValue);
                            $("#time-container").show();
                            var entertainerID = '.$entertainerID.';
                            $("#modal-schedule-content").modal("show");
                            $.ajax({
                                url: App.base_path + "entertainers/get-busy-schedule",
                                type: "POST",
                                    data: { date: dateValue, entertainer_id:entertainerID},
                                    success: function(data) {
                                        $(".busy-schedule-table tbody").html(data);
                                    }
                            });
                        }'
                    ),
                    'dayRender' => new \yii\web\JsExpression('
                        function (date, cell) {
                            var check = $.fullCalendar.formatDate(date,"YYYY-MM-DD");
                            var selectedDateInOrder = "'.(!empty($orderData['event_date']) ? $orderData['event_date'] : '').'";
                            if(check == selectedDateInOrder) {
                                cell.css("background-color","red");
                            }else{
                                //cell.css("background-color","green");
                            }

                            //#787878

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
        <?php 
            $eventDate = $orderData['event_date'];
            $startTime = $orderData['start_time'];
            $endTime = $orderData['end_time'];
            $startEndTimeStatement = (!empty($startTime) && !empty($endTime)) ? ($startTime.'-'.$endTime) : '';
            $entertainersCount = $orderData['entertainers_count'];
        ?>
        <div class="well" id="date-time-container" style="display:block;">
            <p>
                <label style="color: #1c1c92;font-size: 17px;">Event Date: </label>
                &nbsp;<span class="selected-date"><?=$eventDate;?></span>
                <?= Html::hiddenInput('selected_date', $eventDate, ['class' => 'selected-date-class']); ?>
            </p>
            <p>
            <label style="color: #1c1c92;font-size: 17px;">Event Time:</label>
            <span id="event-time"><?=$startEndTimeStatement;?></span> <br />
            <label style="color: #1c1c92;font-size: 17px;">Entertainers: </label>
            <span id="entertainers-count-raw"><?=$entertainersCount?></span>
            <input type="hidden" name="start_time" class="start-time-class" value="<?=$startTime;?>" />
            <input type="hidden" name="end_time" class="end-time-class" value="<?=$endTime;?>" />
            <input type="hidden" name="entertainers_count" class="entertainers-count" value="<?=$entertainersCount;?>" />
            </p>
        </div>
    </div>
</div>
<?php 
    $makeBookingClass = 'collapse in';
    $ariaExpandedClass = 'true';
    $partyTypeID = $orderData['party_type_id'];
    $priceType = $orderData['price_type'];
    $themeServiceID = $orderData['theme_service_id'];
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="make-booking-container">
    <p>
        <a class="btn btn-info make-a-booking-class" data-toggle="collapse" href="#make-booking" role="link" aria-expanded="<?=$ariaExpandedClass;?>" aria-controls="make-booking">
            Make a booking<i class="glyphicon glyphicon-chevron-down pull-right"></i>
        </a>
    </p>
    <div class="<?=$makeBookingClass;?>" id="make-booking">
        <div class="card card-body">
            <div style="color: #1c1c92;font-size:16px;">1. Choose date and time on the calendar above</div>
            <div style="color: #1c1c92;font-size:16px;">2. Choose services</div>

            <div class="form-group">
                <?= Html::dropDownList('party_type_id', $partyTypeID, ArrayHelper::map(PartyType::find()->all(), 'id', 'name'), ['prompt' => 'Party type', 'class' => 'form-control party-type-class']); ?>
            </div>

            <!--<div class="form-group">
                <?=Html::dropdownList('price_type',$priceType,['service'=>'Service','package'=>'Package'], ['class' => 'form-control price-type-class']);?>
            </div>-->
            <div class="panel panel-info">
                    <div class="panel-heading">Theme Services</div>
                    <div class="panel-body">
                        <div class="form-group">
                        <?= Html::dropDownList('party_theme_id', $themeServiceID, ArrayHelper::map(PartyTheme::find()->where(['type'=>'theme'])->all(), 'id', 'name'), ['prompt' => 'Theme', 'class' => 'form-control party-theme-class']); ?>
                        </div>

                        <div class="table-responsive price-theme-table">
                        <?php
                            if(!empty($entertainerOrderThemePrices)){
                                echo $this->renderAjax('_prices_by_theme', [
                                    'entertainerPriceData' => $entertainerPriceData,
                                    'entertainerOrderThemePrices'=>$entertainerOrderThemePrices,
                                    ]
                                );
                            }
                        ?>
                        </div>
                    </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">Additional Services</div>
                <div class="panel-body">
                    <div class="form-group">
                        <?= Html::dropDownList('party_theme_id', '', ArrayHelper::map(PartyTheme::find()->where(['type'=>'additional_services'])->all(), 'id', 'name'), ['prompt' => 'Additional services', 'class' => 'form-control additional-services-class']); ?>
                    </div>
                    <div class="table-responsive price-additional-services-table">
                            
                    </div>
                </div>
            </div>
            <?php
            /*if($priceType == 'service'){
                $entertainerPriceData = EntertainerServices::find()->where(['entertainer_id'=>$orderData['entertainer_id']])->all();
                $entertainerOrderPriceData = EntertainerOrderPrices::find()->where(['entertainer_id'=>$orderData['entertainer_id'], 'customer_id'=>$orderData['customer_id'], 'order_id'=>$orderData['id']])->all();
                $entertainerOrderPriceList = array_map(function($data){
                    return $data->entertainer_service_id;
                }, $entertainerOrderPriceData);
                if($entertainerPriceData){
                    echo $this->render('../entertainers/_services',['entertainerPriceData'=>$entertainerPriceData,'orderModel'=>$orderData,'entertainerOrderPriceList'=>$entertainerOrderPriceList]);
                }
                ?>
                

                <?php
            }elseif($priceType == 'package'){
                $entertainerPackageData = EntertainerPackages::find()->where(['entertainer_id'=>$orderData['entertainer_id']])->all();
                if($entertainerPackageData){
                    echo $this->render('../entertainers/_packages',['entertainerPackageData'=>$entertainerPackageData, 'orderModel'=>$orderData]);
                }
            }else{
                
            }*/

            ?>
            <div class="total-price-container">
                <span class="label-class">Total:<?=$orderData['price'];?></span>
                <span class="total-price"></span>
            </div>
            <?php if (Yii::$app->user->identity): ?>
                <?php $hostChildAge = $orderData['host_child_age'];?>
                <?php $hostChildGender = $orderData['host_child_gender'] == 'male' ? 'male' : 'female';?>
                <?php $hostChildName = $orderData['host_child_name'];?>
                <?php $telephoneNumber = $orderData['telephone_number'];?>
                <?php $specialRequest = $orderData['special_requests'];?>
                <?php $venueAddress = $orderData['venue_address'];?>
                <?php $postCode = $orderData['post_code'];?>
                <?php $city = $orderData['city'];?>
                <div class="well">
                    <h2>Survey Questions</h2>
                    <div><hr /></div>
                    <div class="form-group">
                        <label class="label-class">Age of Host Child at the event date</label>
                        <?= Html::textInput('host_child_age', $hostChildAge, ['class' => 'form-control host-child-age-class']); ?>
                    </div>
                    <div class="form-group">
                        <label class="label-class">Gender of Host Child</label>
                        <?= Html::radioList('host_child_gender', $hostChildGender, ['male' => 'male', 'female' => 'female'], ['separator' => '<br>', 'class' => 'host-child-gender-class']); ?>
                    </div>
                    <div class="form-group">
                        <label class="label-class">Name of Host Child</label>
                        <?= Html::textInput('host_child_name', $hostChildName, ['class' => 'form-control host-child-name-class']); ?>
                    </div>
                    <div class="form-group">
                        <label class="label-class">Tel number, incl. mobile tel of the host</label>
                        <?= Html::textInput('telephone_number', $telephoneNumber, ['class' => 'form-control telephone-number-class']); ?>
                    </div>
                    <div class="form-group">
                        <label class="label-class">Special Requests</label>
                        <?= Html::textarea('special_requests', $specialRequest, ['class' => 'form-control special-request-class']); ?>
                    </div>
                        <?php 
                            $venueManullyCheck = (!($venueAddress == '' && $postCode == '' && $city == '')) ? true : false; 
                        ?>
                        <div class="checkbox">
                            <label style="color: #1c1c92;font-size: 21px;"><?= Html::checkBox('', $venueManullyCheck, ['class'=>'already-have-venue-checkbox-classs']); ?>Already have a venue</label>
                        </div>
                        <?php
                        if($venueManullyCheck) {
                            $venueManuallyDisplay = 'display:block;';
                            $searchVenueDisplay = 'display:none;';
                        }else{
                            $venueManuallyDisplay = 'display:none;';
                            $searchVenueDisplay = 'display:block;';
                        }
                        ?>

                        <div class="manually-venue-container-save" style="<?=$venueManuallyDisplay;?>">
                                <div class="form-group">
                                    <?= Html::textInput('venue_address', $venueAddress, ['class' => 'form-control venue-address-class','placeholder'=>'First line of address']); ?>
                                </div>
                                <div class="form-group">
                                    <?= Html::textInput('post_code', $postCode, ['class' => 'form-control post-code-class','placeholder'=>'Post code']); ?>
                                </div>
                                <div class="form-group">
                                    <?= Html::textInput('city', $city, ['class' => 'form-control city-class','placeholder'=>'City']); ?>
                                </div>
                            </div>
                        <div class="search-venue-container-save" style="<?=$searchVenueDisplay;?>">
                            <p>
                                <label>Selected venue:</label> <?=!(empty($venueOrderData)) ? '<a href="venue/page?id='.$venueOrderData['venue_id'].'" target="_blank">'.$venueOrderData['name'].'</a>' : '';?>
                            </p>
                            <p>
                                <a href="http://jolly-rex.front/venue/" class="btn btn-success" target="_blank">Search venue now</a>&nbsp;
                                <a href="http://jolly-rex.front/orders/basket/" class="btn btn-danger" target="_blank">Go basket</a>
                            </p>
                        </div> 
                </div>
                <div class="form-group text-center">
                    <?=Html::button('Save', ['class' => 'btn btn-success save-order-class','style'=>'color: #fff;background-color: #11bb11;', 'rel' => $entertainerID]);
                    ?>
                </div>
                <div class="well venue-selection-container" style="display:none;">
                    <div class="form-group">
                        <label>Venue</label><br />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-link venue-yes">Party venue is sorted</button><br />
                        <button class="btn btn-link venue-no">Party venue is NOT sorted yet</button>
                    </div>
                    <div class="venue-address-input" style="display:none;">
                        <div class="form-group">
                            <?= Html::textInput('venue_address', '', ['class' => 'form-control venue-address-class','placeholder'=>'First line of address']); ?>
                        </div>
                        <div class="form-group">
                            <?= Html::textInput('post_code', '', ['class' => 'form-control post-code-class','placeholder'=>'Post code']); ?>
                        </div>
                        <div class="form-group">
                            <?= Html::textInput('city', '', ['class' => 'form-control city-class','placeholder'=>'City']); ?>
                        </div>
                        <a href="http://jolly-rex.front/orders/basket/" class="btn btn-success btn-block venue-manually-fill-go-basket" target="_blank" style='color: #fff;background-color: #11bb11;' rel="">Go to basket</a>
                    </div>
                    <div class="form-group">   
                        <?= Html::hiddenInput('customer_id', Yii::$app->user->identity->id, ['class' => 'form-control customer-id-class']); ?>
                        <?= Html::hiddenInput('entertainer_id', $entertainerID, ['class' => 'form-control entertainer-id-class']); ?>
                    </div>
                </div>
            <?php else: ?>
                <div>You should be logged in/registered to able to do booking</div>
            <?php endif; ?>
        </div>
    </div>
</div>
