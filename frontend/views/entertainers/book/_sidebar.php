
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

$entertainerID = $entertainerData['id'];
$supportInstantBooking = $entertainerData['support_instant_booking'];
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
                'id' => 'calendar',
                'clientOptions' => [
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
        <div class="well" id="date-time-container" style="display:none;">
            <p>
                <label style="color: #337ab7;font-size: 17px;">Event Date: </label>
                &nbsp;<span class="selected-date"></span>
                <?= Html::hiddenInput('selected_date', '', ['class' => 'selected-date-class']); ?>
            </p>
            <p>
            <label style="color: #337ab7;font-size: 17px;">Event Time:</label>
            <span id="event-time"></span> <br />
            <label style="color: #337ab7;font-size: 17px;">Entertainers: </label>
            <span id="entertainers-count-raw"></span>
            <input type="hidden" name="start_time" class="start-time-class" value="" />
            <input type="hidden" name="end_time" class="end-time-class" value="" />
            <input type="hidden" name="entertainers_count" class="entertainers-count" value="" />
            </p>
        </div>
    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="make-booking-container">
    <p>
        <a class="btn btn-info make-a-booking-class" data-toggle="collapse" href="#make-booking" role="link" aria-expanded="true" aria-controls="make-booking">
            Make a booking<i class="glyphicon glyphicon-chevron-down pull-right"></i>
        </a>
    </p>
    <div class="collapse" id="make-booking">
        <div class="card card-body">
            <div style="color: #337ab7;font-size:20px;">1. Choose date and time on the calendar above</div>
            <div style="color: #337ab7;font-size:20px;">2. Choose services</div>

            <div class="form-group">
                <?= Html::dropDownList('party_type_id', '', ArrayHelper::map(PartyType::find()->all(), 'id', 'name'), ['prompt' => 'Party type', 'class' => 'form-control party-type-class']); ?>
            </div>

            <!--<div class="form-group">
                <?=Html::dropdownList('price_type','',['service'=>'Service','package'=>'Package'], ['class' => 'form-control price-type-class']);?>
            </div>-->
            <div class="panel panel-info">
                    <div class="panel-heading">Theme Services</div>
                    <div class="panel-body">
                        <div class="form-group">
                        <?= Html::dropDownList('party_theme_id', '', ArrayHelper::map(PartyTheme::find()->where(['type'=>'theme'])->all(), 'id', 'name'), ['prompt' => 'Theme', 'class' => 'form-control party-theme-class']); ?>
                        </div>

                        <div class="table-responsive price-theme-table"></div>
                    </div>
            </div>
            
            <div class="panel panel-info">
                    <div class="panel-heading">Extra Themes</div>
                    <div class="panel-body">
                        <div class="form-group">
                        <?= Html::dropDownList('extra_theme_option', '', [1 => 'One Extra',2 => 'Two extras'], ['prompt' => 'Theme', 'class' => 'form-control extra-theme-class']); ?>
                        </div>

                        <div class="table-responsive extra-theme-table">
                            <?=$this->render('../_extra_themes',['entertainerExtraThemeServices'=>$entertainerExtraThemeServices]);?>
                        </div>
                    </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">Additional Services</div>
                <div class="panel-body">
                    <div class="form-group">
                        <?= Html::dropDownList('additional_service_id', '', ArrayHelper::map(PartyTheme::find()->where(['type'=>'additional_services'])->all(), 'id', 'name'), ['prompt' => 'Additional services', 'class' => 'form-control additional-services-class']); ?>
                    </div>
                    <div class="table-responsive price-additional-services-table">
                            
                    </div>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">Additional Products</div>
                <div class="panel-body">
                    <div class="table-responsive additional-products-table">
                    <?=$this->render('../_additional_products',['entertainerAdditionalProductsServices'=>$entertainerAdditionalProductsServices]);?> 
                    </div>
                </div>
            </div>
            
            <div class="total-price-container">
                <span class="label-class">Total:</span>
                <span class="total-price">0</span>
            </div>
            <?php if (Yii::$app->user->identity): ?>
                <div class="well">
                    <div class="form-group">
                        <label class="label-class">Name of Host Child</label>
                        <?= Html::textInput('host_child_name', '', ['class' => 'form-control host-child-name-class']); ?>
                    </div>
                    <div class="form-group">
                        <label class="label-class">Age of Host Child on the event date</label>
                        <?= Html::textInput('host_child_age', '', ['class' => 'form-control host-child-age-class']); ?>
                    </div>
                    <div class="form-group">
                        <label class="label-class">Gender of Host Child</label>
                        <?= Html::radioList('host_child_gender', '', ['male' => 'male', 'female' => 'female'], ['separator' => '<br>', 'class' => 'host-child-gender-class']); ?>
                    </div>
                    <div class="form-group">
                        <label class="label-class">Special Requests</label>
                        <?= Html::textarea('special_requests', '', ['class' => 'form-control special-requests-class']); ?>
                    </div>
                    <div class="form-group">
                        <h2 class="header-label-class">Contact Information</h2>
                        <hr />
                    </div>
                    <div class="form-group">
                        <label class="label-class">Title</label>
                        <?= Html::dropdownList('title', '',['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms','Miss'=>'Miss'], ['class' => 'form-control title-class']); ?>
                    </div>
                    <div class="form-group">
                        <label class="label-class">Name and Surname</label>
                        <?= Html::textInput('name', '', ['class' => 'form-control name-class']); ?>
                    </div>
                    <div class="form-group">
                        <label class="label-class">Email</label>
                        <?= Html::textInput('name', '', ['class' => 'form-control email-class']); ?>
                    </div>
                    <div class="form-group">
                        <label class="label-class">Phone Number</label>
                        <?= Html::textInput('name', '', ['class' => 'form-control phone-number-class']); ?>
                    </div>
                    <div class="form-group">
                        <label class="label-class">Mobile Number</label>
                        <?= Html::textInput('telephone_number', '', ['class' => 'form-control mobile-number-class']); ?>
                    </div>
                </div>
                <div class="form-group text-center">
                    <?=Html::button('Add to basket', ['class' => 'btn btn-success book-entertainer-for-event','style'=>'color: #fff;background-color: #11bb11;', 'rel' => $entertainerID]); ?>
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
                            <?= Html::textInput('area', '', ['class' => 'form-control area-class','placeholder'=>'Area']); ?>
                        </div>
                        <div class="form-group">
                            <?= Html::textInput('city', '', ['class' => 'form-control city-class','placeholder'=>'City']); ?>
                        </div>
                        <a href="http://jolly-rex.front/orders/basket/" class="btn btn-success btn-block venue-manually-fill-go-basket" target="_blank" style='color: #fff;background-color: #11bb11;' rel="">Go to basket</a>
                    </div>
                    <div class="form-group">   
                        <?= Html::hiddenInput('customer_id', Yii::$app->user->identity->id, ['class' => 'form-control customer-id-class']); ?>
                        <?= Html::hiddenInput('entertainer_id', $entertainerID, ['class' => 'form-control entertainer-id-class']); ?>
                        <?= Html::hiddenInput('support_instant_booking', $supportInstantBooking, ['class' => 'form-control support-instant-booking-class']); ?>
                        <?=Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken);?>
                    </div>
                </div>
            <?php else: ?>
                <div>You should be logged in/registered to able to do booking</div>
            <?php endif; ?>
        </div>
    </div>
</div>
