<?php

use common\models\User;
use common\models\Entertainer;
use yii\helpers\Html;
use yii\web\View;
use kartik\datetime\DateTimePicker;
use \yii2fullcalendar\yii2fullcalendar;
use kartik\time\TimePicker;
use frontend\components\SlideshowWidget;
use yii\helpers\ArrayHelper;
use common\models\PartyType;

$this->registerCssFile("@web/css/entertainers/page.css");
$this->registerJsFile('@web/js/entertainer/page.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile("@web/css/entertainers/test_style.css");
$this->registerJsFile('@web/js/entertainer/test_js.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = $userData['name'] . ' entertainer page';
?>
<div class="container-fluid">
    <div class="entertainer-active-order-line">
        <?=$this->render('/orders/active-order-line',['order'=>$orderData]); ?>
    </div>
</div>
<div class="container-fluid">
    <!-- <div style='background-image: url("/images/bracket.png");width:100%;height:100%;background-repeat:no-repeat;'></div> -->
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 calendar_class">
            <nav id="sidebar">
                <?= $this->render('_sidebar', [
                        'entertainerID' => $entertainerID,
                        'entertainerPriceData' => $entertainerPriceData,
                        'entertainerOrderThemePrices' => $entertainerOrderThemePrices,
                        'entertainerOrderAdditionalServicePrices' => $entertainerOrderAdditionalServicePrices,
                        'orderData' => $orderData,
                        'venueOrderData' => $venueOrderData
                    ]
                );
                ?>
            </nav>
        </div>
        <!-- Page Content Holder -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 info_class">
            <div id="content">
                <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                    <i class="glyphicon glyphicon-align-left"></i>
                    <span>Enlarge</span>
                </button>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?= $this->render('_main_info', ['userData' => $userData]); ?>
                    <?= $this->render('_video', ['userData' => $userData]); ?>
                    <?= $this->render('_description', ['userData' => $userData]); ?>
                    <?= $this->render('_party_theme', ['entertainerPartyThemes' => $entertainerPartyThemes]); ?>
                    <?= $this->render('_price_description', ['userData' => $userData]); ?>
                    <?= $this->render('_gallery', []); ?>
                    <?= $this->render('_staff', ['entertainerStaff' => $entertainerStaff]); ?>
                    <?= $this->render('_about_us', ['supplierReviews' => $supplierReviews, 'entertainerID' => $entertainerID, 'customerOwnReview' => $customerOwnReview]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
\yii\bootstrap\Modal::begin([
    'id' => 'finish-booking-modal',
    'size' => 'modal-lg'
]);
?>

<div id="finish-booking-modal-content">
    <?php $message = ($userData['support_instant_booking']) ? 'Thank you for order!' : 'Thanks, we will contact you shortly'; ?>
    <p><?= $message; ?></p>
    <p>
        <a href="http://jolly-rex.front/orders/basket/" class="button btn btn-success">Go to Basket</a>
        <a href="http://jolly-rex.front/" class="button btn btn-success">Continue</a>
</div>
<?php
\yii\bootstrap\Modal::end();
?>

<?php
\yii\bootstrap\Modal::begin([
    'id' => 'orders-modal',
    'size' => 'modal-lg'
]);

echo "<div id='orders-modal-content'></div>";

\yii\bootstrap\Modal::end();
?>

<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h4>Title</h4>',
    'id' => 'modal',
    'size' => 'modal-lg'
]);

echo "<div id='modalContent'></div>";

\yii\bootstrap\Modal::end();
?>

<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h4>Schedule calendar</h4>',
    'id' => 'modal-calendar',
    'size' => 'modal-lg'
]);
?>
<div id="modal-calendar-content">
    <?=
    yii2fullcalendar::widget(array(
        //'events' => $events,
        'clientOptions' => [
            'defaultView' => 'listWeek'
        ],
    ));
    ?>
</div>
<?php
\yii\bootstrap\Modal::end();
?>

<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h4>Schedule</h4>',
    'id' => 'modal-schedule-content',
    'size' => 'modal-lg'
]);

$str = "<div id='modal-schedule-container'>";
$str .= Html::beginTag('div', ['class' => 'modal-body']);
$str .= Html::beginTag('div', ['class' => 'panel panel-warning']);
$str .= Html::beginTag('div', ['class' => 'panel-heading']);
$str .= 'Choose Your Time Now';
$str .= Html::endTag('div');
$str .= Html::beginTag('div', ['class' => 'panel-body']);
$str .= Html::beginTag('table', ['class' => 'table table-bordered']);
$str .= Html::beginTag('tr');
$str .= Html::beginTag('th');
$str .= 'Start';
$str .= Html::endTag('th');
$str .= Html::beginTag('th');
$str .= 'End';
$str .= Html::endTag('th');
$str .= Html::beginTag('th');
$str .= 'How many entertainers?';
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
            'value' => date('H:i', time() + 3600),
            'pluginOptions' => [
                'showSeconds' => false,
                'showMeridian' => false,
            ],
            'options' => [
                'class' => 'end-time'
            ],
        ]);
$str .= Html::endTag('td');
$str .= Html::beginTag('td');
$str .= Html::textInput('', '', ['class' => 'form-control entertainers-count-class']);
$str .= Html::endTag('td');
$str .= Html::endTag('tr');
$str .= Html::beginTag('tr');
$str .= Html::beginTag('td', ['colspan' => '3']);
$str .= Html::beginTag('div', ['class' => 'validation-message-container']);
//@TODO put validation message if selected time is not available or there is lack of entertainers
$str .= Html::endTag('div');
$str .= Html::endTag('td');
$str .= Html::endTag('tr');
$str .= Html::endTag('table');

$str .= Html::beginTag('div', ['class' => 'cols-lg-6 cols-md-6 cols-sm-6 cols-xs-12']);
$str .= Html::beginTag('div', ['class' => 'form-group']);
$str .= Html::button('Choose', ['class' => 'btn btn-primary choose-date-class']);
$str .= Html::endTag('div');
$str .= Html::endTag('div');

$str .= Html::endTag('div');
$str .= Html::endTag('div');

$str .= Html::beginTag('div', ['class' => 'panel panel-danger']);
$str .= Html::beginTag('div', ['class' => 'panel-heading']);
$str .= 'No Entertainers Available at This Time';
$str .= Html::endTag('div');
$str .= Html::beginTag('div', ['class' => 'panel-body']);
$str .= Html::beginTag('table', ['class' => 'table table-borderedless busy-schedule-table']);
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


<?php
\yii\bootstrap\Modal::begin([
    'id' => 'venue-search-options-modal',
    'size' => 'modal-lg'
]);
?>

<div id="venue-search-options-modal-content" class="text-center" style="margin-bottom:20px;">
    <a href="http://jolly-rex.front/venue/" class="btn btn-success ready-search-venue-class" style="width: 260px;font-size:15px;" target="_blank">Ready to search for venue now</a><br />
    <!-- <a href="http://jolly-rex.front/orders/basket/" class="btn btn-danger btn-block not-ready-search-venue-class" target="_blank">Not ready to search for venue yet</a> -->
    <button class="btn btn-danger not-ready-search-venue-class" style="margin-top: 25px; width: 260px;font-size:15px;" target="_blank">Not ready to search for venue yet</button>
</div>
<div id="entertainer-geo-locations">
    
</div>
<?php \yii\bootstrap\Modal::end();?>