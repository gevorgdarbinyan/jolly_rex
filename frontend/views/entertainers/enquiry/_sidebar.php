
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
use kartik\date\DatePicker;

$entertainerID = $entertainerData['id'];
$supportInstantBooking = $entertainerData['support_instant_booking'];
$geoLocationString = implode(', ',array_map(function($item) {return $item['postal_code_name'];}, $geoLocations));
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="text-align-center">
        <?= Html::img('@web/images/Layer.jpg', ['class' => 'img-circle']); ?>
    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="make-booking-container">
    <div style="margin:20px 0px;" class="text-center">
    <h3 style="color: #337ab7;">Entertainer's Tentative Availability</h3> 
    </div>
    <div style="margin-bottom: 20px;">
    <?php
    echo yii2fullcalendar::widget(array(
        'id' => 'calendar',
        'clientOptions' => [
            'header' => ['right' => ''],
            'dayClick' => new \yii\web\JsExpression('
                function (date, jsEvent, view) {
                    
                }'
            ),
            'dayRender' => new \yii\web\JsExpression('
                function (date, cell) {
                    
                }'
            ),
        ],
    ));
    ?>
    </div>
    <p>
        <a class="btn btn-info make-a-booking-class" data-toggle="collapse" href="#make-booking" role="link" aria-expanded="true" aria-controls="make-booking">
            Make an enquiry<i class="glyphicon glyphicon-chevron-down pull-right"></i>
        </a>
    </p>
    <div class="collapse" id="make-booking">
        <div class="card card-body">
            <div class="dates-container">
                <div class="form-group">
                    <?php if(empty($entertainerBranchesData)): ?>
                    <label style="color: #337ab7;font-size:20px;">From Location:</label> <?=$entertainerData['area'].', '.$entertainerData['city'];?>
                    <?=Html::hiddenInput('',$entertainerData['post_code'],['class'=>'origin-post-code-class']);?>
                    <?php else:?>
                    <?php $entertainerBranches = ArrayHelper::map($entertainerBranchesData,'post_code','branchNames');?>
                    <label>From(Entertainer Locations)</label>
                    <?=Html::dropdownList('','',[$entertainerData['post_code'] => $entertainerData['area'].', '.$entertainerData['city'].'(Main office)']+$entertainerBranches,['prompt'=>'Locations','class'=>'form-control origin-post-code-class']);?>
                    <?php endif;?>
                </div>
                <div class="form-group">
                    <hr />
                    <h4>Venue</h4>
                </div>
                <div class="form-group">
                    <select class="form-control party-venue-sorted-option-class">
                        <option>Is party venue sorted?</option>
                        <option value="1">Party venue is sorted</option>
                        <option value="2">Party venue is NOT sorted yet</option>
                    </select>
                </div>
                <div class="sorted-venue-address-input" style="display:none;">
                    <div class="form-group">
                        <?= Html::textInput('first_line_address', '', ['class' => 'form-control first-line-address-class','placeholder'=>'First line of address']); ?>
                    </div>
                    <div class="form-group">
                        <?= Html::textInput('post_code', '', ['class' => 'form-control distance-post-code-class','placeholder'=>'Post code']); ?>
                    </div>
                    <div class="form-group">
                        <?= Html::textInput('area', '', ['class' => 'form-control area-class','placeholder'=>'Area']); ?>
                    </div>
                    <div class="form-group">
                        <?= Html::textInput('city', '', ['class' => 'form-control city-class','placeholder'=>'City']); ?>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary calculate-distance">Calculate</button>
                    </div>
                    <div id="mileage-result-container"></div>
                </div>
                <div id="warning-venue-message" style="display:none;margin:20px 0px;font-size: 16px;">
                <h4 style="color:red;">WARNING!</h4><br />
                <strong>This entertainer only covers the following areas:</strong><br />
                <span style="color:#337ab7;"><?=$geoLocationString;?></span>
                </div>
                <div style="color: #337ab7;font-size:20px;">1. Choose date and time</div>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-xs-12 col-sm-12"><h6>Option 1</h6></div>
                    <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <?php
                            echo DatePicker::widget([
                                'name' => 'EntertainerEnquiry[busy_date]', 
                                'value' => '',
                                'options' => ['placeholder' => 'Date ...','class' => 'option1-date-class'],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'todayHighlight' => true,
                                    'autoclose'=>true,
                                ]
                            ]);?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <?=TimePicker::widget([
                                    'name' => 'start_time',
                                    'value' => "00:00",
                                    'pluginOptions' => [
                                        'showSeconds' => false,
                                        'showMeridian' => false,
                                    ],
                                    'options' => [
                                        'class' => 'option1-start-time'
                                    ],
                                ]);
                                ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <?=TimePicker::widget([
                                'name' => 'end_time',
                                'value' => "00:00",
                                'pluginOptions' => [
                                    'showSeconds' => false,
                                    'showMeridian' => false,
                                ],
                                'options' => [
                                    'class' => 'option1-end-time'
                                ],
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-xs-12 col-sm-12"><h6>Option 2</h6></div>
                    <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <?php
                            echo DatePicker::widget([
                                'name' => 'EntertainerBusySchedule[busy_date]', 
                                'value' => '',
                                'options' => ['placeholder' => 'Date ...','class' => 'option2-date-class'],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'todayHighlight' => true,
                                    'autoclose'=>true,
                                ]
                            ]);?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <?=TimePicker::widget([
                                    'name' => 'start_time',
                                    'value' => "00:00",
                                    'pluginOptions' => [
                                        'showSeconds' => false,
                                        'showMeridian' => false,
                                    ],
                                    'options' => [
                                        'class' => 'option2-start-time'
                                    ],
                                ]);
                                ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <?=TimePicker::widget([
                                'name' => 'end_time',
                                'value' => "00:00",
                                'pluginOptions' => [
                                    'showSeconds' => false,
                                    'showMeridian' => false,
                                ],
                                'options' => [
                                    'class' => 'option2-end-time'
                                ],
                            ]);
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2 col-md-2 col-xs-12 col-sm-12"><h6>Option 3</h6></div>
                    <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <?php
                            echo DatePicker::widget([
                                'name' => 'EntertainerBusySchedule[busy_date]', 
                                'value' => '',
                                'options' => ['placeholder' => 'Date ...','class' => 'option3-date-class'],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'todayHighlight' => true,
                                    'autoclose'=>true,
                                ]
                            ]);?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <?=TimePicker::widget([
                                    'name' => 'start_time',
                                    'value' => "00:00",
                                    'pluginOptions' => [
                                        'showSeconds' => false,
                                        'showMeridian' => false,
                                    ],
                                    'options' => [
                                        'class' => 'option3-start-time'
                                    ],
                                ]);
                                ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <?=TimePicker::widget([
                                'name' => 'end_time',
                                'value' => "00:00",
                                'pluginOptions' => [
                                    'showSeconds' => false,
                                    'showMeridian' => false,
                                ],
                                'options' => [
                                    'class' => 'option3-end-time'
                                ],
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label style="color: #337ab7;font-size:20px;">How many entertainers?</label>
                            <?=Html::textInput('', '', ['class' => 'form-control entertainers-count-class']);?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div style="color: #337ab7;font-size:20px;">2. Choose services</div>

            <div class="form-group">
                <?= Html::dropDownList('party_type_id', '', ArrayHelper::map(PartyType::find()->all(), 'id', 'name'), ['prompt' => 'Party type', 'class' => 'form-control party-type-class']); ?>
            </div>

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
                £ <span class="total-price">0</span>
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
                    <?=Html::button('Send your enquiry', ['class' => 'btn btn-success make-entertainer-enquiry','style'=>'color: #fff;background-color: #11bb11;', 'rel' => $entertainerID]); ?>
                </div>
                <div class="form-group">   
                    <?= Html::hiddenInput('customer_id', Yii::$app->user->identity->id, ['class' => 'form-control customer-id-class']); ?>
                    <?= Html::hiddenInput('entertainer_id', $entertainerID, ['class' => 'form-control entertainer-id-class']); ?>
                    <?= Html::hiddenInput('entertainer_mileage_id', $entertainerData['mileage_price'], ['class' => 'form-control entertainer-mileage-price-class']); ?>
                    <?= Html::hiddenInput('support_instant_booking', $supportInstantBooking, ['class' => 'form-control support-instant-booking-class']); ?>
                    <?=Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken);?>
                </div>
            <?php else: ?>
                <div>You should be logged in/registered to able to do booking</div>
            <?php endif; ?>
        </div>
    </div>
</div>
