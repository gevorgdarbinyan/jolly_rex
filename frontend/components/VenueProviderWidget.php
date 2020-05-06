<?php
namespace frontend\components;

use yii\base\Widget;
use common\models\Orders;
use common\models\Venue;
use yii\helpers\Html;

class VenueProviderWidget extends Widget {
    public $content;
    public $userData;
    public $userTypeData;
    public $userSearchModel;
    public $dataProvider;
    
    public function init() {
        parent::init();
        $this->content = Html::beginTag('div', ['class' => 'row']);
        $this->content .= Html::beginTag('div', ['class' => 'col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1']);
        $this->content .= Html::beginTag('div', ['class' => 'venue-dashboard-internal']);
        $this->content .= $this->drawHeader($this->userData);
        $this->content .= $this->drawContent($this->userData);
        $this->content .= Html::endTag('div');
        $this->content .= Html::endTag('div');
        $this->content .= Html::endTag('div');
    }

    public function run(){
        return $this->content;
    }
    
    public function drawHeader($userData) {
        $str = Html::beginTag('div', ['class' => 'row']);
        $str .= Html::beginTag('div', ['class' => 'col-lg-4 col-md-4 col-sm-12 col-xs-12']);
        $str .= $this->getVenuePhoto($userData->id);
        $str .= Html::endTag('div');
        $str .= Html::beginTag('div', ['class' => 'col-lg-8 col-md-8 col-sm-12 col-xs-12']);
        $str .= $this->getVenueTitle($userData);
        $str .= Html::endTag('div');
        $str .= Html::endTag('div');

        return $str;
    }
    
    public function getVenuePhoto($venueID) {
//        $entertainerPhotoData = UserPhotos::find()
//                ->where(['user_id' => $venueID, 'type' => 'main'])
//                ->one();
//        $userPhoto = Html::img(Yii::getAlias('@root') . '/common/uploads/' . $entertainerPhotoData['id'] . '/main/' . $entertainerPhotoData['photo'], []);
        $userPhoto = Html::img('@web/images/venueLayer.jpg', ['class' => 'venue-dashboard-photo']);
        return $userPhoto;
    }
    
    public function getVenueTitle($userData) {
        $str = Html::beginTag('h1', ['class' => 'venue-dashboard-title']);
        $str .= 'Welcome, ';
        $str .= $userData->email;
        $str .= Html::endTag('h1');

        return $str;
    }
    
    public function drawContent($userData) {
        $str = Html::beginTag('div', ['class' => 'row']);
        $str .= Html::beginTag('div', ['class' => 'col-lg-4 col-md-4 col-sm-12 col-xs-12']);
//            $str .= 
//            yii2fullcalendar::widget(array(
//                'clientOptions' => [
//                    'header' => ['right' => ''],
//                    'dayClick' => new \yii\web\JsExpression('
//                        function (date, jsEvent, view) {
//                            var dateValue = date.format();
//                            
//                            var dateExpression = new Date(dateValue);
//                            var toDateString = dateExpression.toDateString();
//
//
//                            //console.log(typeof dateValue);
//                            //console.log("Clicked on: " + date.format());
//                            // console.log("Coordinates: " + jsEvent.pageX + "," + jsEvent.pageY);
//                            // console.log("Current view: " + view.name);
//
//                            $(this).css("background-color", "red");
//                            $(".selected-date").html(toDateString);
//                            $(".selected-date-class").val(dateValue);
//                            $("#time-container").show();
//                            var entertainerID = '.Yii::$app->user->identity->id.';
//                            $("#modal-schedule-content").modal("show");
//                            $.ajax({
//                                url: App.base_path + "entertainers/get-busy-schedule",
//                                type: "POST",
//                                    data: { date: dateValue, entertainer_id:entertainerID},
//                                    success: function(data) {
//                                    $(".busy-schedule-table tbody").html(data);
//                                    }
//                            });
//                            
//                        }'
//                    ),
//                    'dayRender' => new \yii\web\JsExpression('
//                        function (date, cell) {
//                            var check = $.fullCalendar.formatDate(date,"YYYY-MM-DD");
//                            console.log(check);
//                            if (moment().diff(date,"days") > 0){
//                                //cell.css("background-color","red");
//                            }else{
//                                //cell.css("background-color", "green");
//                            }
//                        }'
//                    ),
//                ],
//            ));

        $str .= Html::endTag('div');
        $str .= Html::beginTag('div', ['class' => 'col-lg-8 col-md-8 col-sm-12 col-xs-12']);
        $str .= $this->drawOrders($userData->id);
        $str .= Html::endTag('div');
        $str .= Html::endTag('div');

        return $str;
    }
    
    public function drawOrders($venueID) {
        $venue = Venue::find()->where(['user_id'=>$venueID])->asArray()->one();
        $supportInstantBooking = $venue['support_instant_booking'];
        $orders = Orders::find()
                ->select([
                    'tbl_orders.id AS order_id',
                    'tbl_orders.customer_id AS customer_id',
                    'tbl_orders.entertainer_id AS entertainer_id',
                    'tbl_orders.venue_id AS venue_id',
                    'tbl_orders.order_type',
                    'tbl_venue_orders.event_date AS event_date',
                    'tbl_venue_orders.start_time AS start_time',
                    'tbl_venue_orders.end_time AS end_time',
                    'tbl_orders.status AS status',
                    'tbl_orders.price AS price',
                    'tbl_venue.name AS venue_name',
                    'tbl_venue.short_description AS venue_short_description',
                    'tbl_venue.description AS venue_description',
                    'tbl_venue.rating AS venue_rating',
                    'tbl_venue.price AS venue_price',
                    'tbl_venue.postal_code AS venue_postal_code'
                ])
                ->leftJoin('tbl_venue', 'tbl_orders.venue_id = tbl_venue.id')
                ->leftJoin('tbl_venue_orders', 'tbl_orders.id = tbl_venue_orders.order_id')
                ->where(['tbl_orders.venue_id'=>$venue['id']])
                ->asArray()
                ->all();
        $venueOrders = [];
        $venueEnquiries = [];
        foreach($orders as $order) {
            if($order['order_type'] === 'order'){
                $venueOrders[] = $order;
            }elseif($order['order_type'] === 'enquiry'){
                $venueEnquiries[] = $order;
            }
        }

        if($supportInstantBooking == 1) {
            
        }
        //out($venueOrders);die;

        $str = '<ul class="nav nav-tabs">';
            $str .= '<li><a data-toggle="tab" href="#orders">Orders</a></li>';
            $str .= '<li><a data-toggle="tab" href="#enquiries">Enquiries</a></li>';
        $str .= '</ul>';
        $str .= ' <div class="tab-content">';
        $str .= '<div id="orders" class="tab-pane fade">';
        foreach ($venueOrders as $order) {
            $str .= Html::beginTag('div', ['style' => 'margin-bottom: 25px;']);
            $str .= Html::beginTag('h4', ['style' => 'margin-bottom: 25px;', 'class' => 'entertainer-dashboard-order-title']);
            $str .= $order['event_date'] . ' | ' . $order['start_time'] . '-' . $order['end_time'];
            $str .= Html::endTag('h4');
            
            if ($order['event_date']) {
                $str .= Html::beginTag('h4', ['class' => 'venue-dashboard-order-title']);
                $str .= 'Event date';
                $str .= Html::endTag('h4');
                $str .= Html::beginTag('p', ['style' => 'margin-bottom: 35px;']);
                $str .= $order['event_date'];
                $str .= Html::endTag('p');
            }

            $orderID = $order['order_id'];
            $str .= Html::beginTag('h4', ['class' => 'venue-dashboard-order-title', 'style' => 'margin-top: 30px;']);
                $str .= (isset($order['service_name'])) ? $order['service_name'] : '';
            $str .= Html::endTag('h4');
            $str .= Html::beginTag('h4', ['style' => 'margin-bottom: 25px;']);
                $str .= 'Guests:';
            $str .= (!empty($order['count_of_guests'])) ? $order['count_of_guests'] : '';
            $str .= Html::endTag('h4');

            if (isset($order['venue_price'])) {
                $str .= Html::beginTag('h4');
                $str .= 'Price: ';
                $str .= (isset($order['venue_price'])) ? '£ '.$order['venue_price'] . ' / hour' : '';
                $str .= Html::endTag('h4');
            }
            
            $time1 = strtotime($order['start_time']);
            $time2 = strtotime($order['end_time']);
            $orderDuration = round(abs($time2 - $time1) / 3600, 2);
            $totalPrice = $orderDuration * $order['venue_price'];
            
            $str .= Html::beginTag('hr', ['class' => 'solid-line']);
            $str .= Html::beginTag('h4');
            $str .= 'Total price: ' . $totalPrice . ' £';

            $str .= Html::endTag('h4');
            if ($order['status'] == 'pending') {
                $str .= Html::beginTag('div', ['class' => 'row']);
                    $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2 col-sm-12 col-xs-12']);
                        $str .= Html::beginTag('div', ['class' => 'form-group']);
                        $str .= Html::button('Accept', ['class' => 'btn btn-primary venue_accept_btn', 'order_id' => $orderID]);
                        $str .= Html::endTag('div');
                        $str .= Html::endTag('div');
                        $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2 col-sm-12 col-xs-12']);
                        $str .= Html::beginTag('div', ['class' => 'form-group']);
                        $str .= Html::button('Decline', ['class' => 'btn btn-danger venue_decline_btn', 'order_id' => $orderID]);
                        $str .= Html::endTag('div');
                    $str .= Html::endTag('div');
                $str .= Html::endTag('div');
            } elseif ($order['status'] == 'Canceled') {
                $str .= Html::beginTag('div', ['class' => 'row']);
                $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2 col-sm-12 col-xs-12']);
                $str .= 'canceled';
                $str .= Html::endTag('div');
                $str .= Html::endTag('div');
            } elseif ($order['status'] == 'Approved') {
                $str .= Html::beginTag('div', ['class' => 'row']);
                $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2 col-sm-12 col-xs-12']);
                $str .= 'approved';
                $str .= Html::endTag('div');
                $str .= Html::endTag('div');
            }
            $str .= Html::endTag('div');
        }
        $str .= '</div>';
        $str .= '<div id="enquiries" class="tab-pane fade">';
        out($venueEnquiries);
        $str .= '<table class="table table-striped">';
        foreach ($venueEnquiries as $order) {
            $str .= '<tr>';
                $str .= '<td>';
                    $str .= $order['event_date'];
                $str .= '</td>';
                $str .= '<td>';
                    $str .= $order['start_time'];
                $str .= '</td>';
                $str .= '<td>';
                    $str .= $order['end_time'];
                $str .= '</td>';
                $str .= '<td>';
                    $str .= $order['price'];
                $str .= '</td>';
                $str .= '<td>';
                    $str .= ($order['status'] == 'non_answered') ? 'Unanswered' : 'answered';
                $str .= '</td>';
                $str .= '<td>';
                $str .= '</td>';
            $str .= '</tr>';
            /*$str .= Html::beginTag('div', ['style' => 'margin-bottom: 25px;']);
            $str .= Html::beginTag('h4', ['style' => 'margin-bottom: 25px;', 'class' => 'entertainer-dashboard-order-title']);
            $str .= $order['event_date'] . ' | ' . $order['start_time'] . '-' . $order['end_time'];
            $str .= Html::endTag('h4');
            
            if ($order['event_date']) {
                $str .= Html::beginTag('h4', ['class' => 'venue-dashboard-order-title']);
                $str .= 'Event date';
                $str .= Html::endTag('h4');
                $str .= Html::beginTag('p', ['style' => 'margin-bottom: 35px;']);
                $str .= $order['event_date'];
                $str .= Html::endTag('p');
            }

            $orderID = $order['order_id'];
            $str .= Html::beginTag('h4', ['class' => 'venue-dashboard-order-title', 'style' => 'margin-top: 30px;']);
                $str .= (isset($order['service_name'])) ? $order['service_name'] : '';
            $str .= Html::endTag('h4');
            $str .= Html::beginTag('h4', ['style' => 'margin-bottom: 25px;']);
                $str .= 'Guests:';
            $str .= (!empty($order['count_of_guests'])) ? $order['count_of_guests'] : '';
            $str .= Html::endTag('h4');

            if (isset($order['venue_price'])) {
                $str .= Html::beginTag('h4');
                $str .= 'Price: ';
                $str .= (isset($order['venue_price'])) ? '£ '.$order['venue_price'] . ' / hour' : '';
                $str .= Html::endTag('h4');
            }
            
            $time1 = strtotime($order['start_time']);
            $time2 = strtotime($order['end_time']);
            $orderDuration = round(abs($time2 - $time1) / 3600, 2);
            $totalPrice = $orderDuration * $order['venue_price'];
            
            $str .= Html::beginTag('hr', ['class' => 'solid-line']);
            $str .= Html::beginTag('h4');
            $str .= 'Total price: ' . $totalPrice . ' £';

            $str .= Html::endTag('h4');
            if ($order['status'] == 'pending') {
                $str .= Html::beginTag('div', ['class' => 'row']);
                    $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2 col-sm-12 col-xs-12']);
                        $str .= Html::beginTag('div', ['class' => 'form-group']);
                        $str .= Html::button('Accept', ['class' => 'btn btn-primary venue_accept_btn', 'order_id' => $orderID]);
                        $str .= Html::endTag('div');
                        $str .= Html::endTag('div');
                        $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2 col-sm-12 col-xs-12']);
                        $str .= Html::beginTag('div', ['class' => 'form-group']);
                        $str .= Html::button('Decline', ['class' => 'btn btn-danger venue_decline_btn', 'order_id' => $orderID]);
                        $str .= Html::endTag('div');
                    $str .= Html::endTag('div');
                $str .= Html::endTag('div');
            } elseif ($order['status'] == 'Canceled') {
                $str .= Html::beginTag('div', ['class' => 'row']);
                $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2 col-sm-12 col-xs-12']);
                $str .= 'canceled';
                $str .= Html::endTag('div');
                $str .= Html::endTag('div');
            } elseif ($order['status'] == 'Approved') {
                $str .= Html::beginTag('div', ['class' => 'row']);
                $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2 col-sm-12 col-xs-12']);
                $str .= 'approved';
                $str .= Html::endTag('div');
                $str .= Html::endTag('div');
            }
            $str .= Html::endTag('div');*/
        }
        $str .= '</table>';
        $str .= '</div>';
        $str .= ' </div>';

        //$str = '';
        
        return $str;
    }
    
}