<?php

namespace frontend\components;

use Yii;
use yii\base\Widget;
use common\models\UserPhotos;
use common\models\Orders;
use common\models\Entertainer;
use common\models\entertainer\EntertainerOrderPrices;
use common\models\entertainer\EntertainerBusySchedule;
use yii\helpers\Html;
use \yii2fullcalendar\yii2fullcalendar;
use kartik\time\TimePicker;
use kartik\date\DatePicker;

class EntertainerWidget extends Widget {

    public $content;
    public $userData;
    public $userTypeData;
    public $userSearchModel;
    public $dataProvider;

    public function init() {
        parent::init();
        $this->content = Html::beginTag('div', ['class' => 'row entertainer-dashboars-internal-background']);
//        $this->content .= Html::beginTag('div', ['class' => 'col-lg-1 col-md-1 entertainer-dashboars-internal-background-left']);
//        $this->content .= Html::endTag('div');
        //$this->content .= Html::beginTag('div', ['class' => 'col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1']);
        $this->content .= Html::beginTag('div', ['class' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12']);
        $this->content .= Html::beginTag('div', ['class' => 'entertainer-dashboard-internal']);
        $this->content .= $this->drawHeader($this->userData);
        $this->content .= $this->drawContent($this->userData);
        $this->content .= Html::endTag('div');
        $this->content .= Html::endTag('div');
//        $this->content .= Html::beginTag('div', ['class' => 'col-lg-1 col-md-1 entertainer-dashboars-internal-background-right']);
//        $this->content .= Html::endTag('div');
        $this->content .= Html::endTag('div');
    }

    public function run() {
        return $this->content;
    }

    private function getData($userID) {
        return Entertainer::find()->where(['user_id'=>$userID])->asArray()->one();
    }

    public function drawHeader($userData) {
        $str = Html::beginTag('div', ['class' => 'row']);
        $str .= Html::beginTag('div', ['class' => 'col-lg-11 col-md-11 col-sm-12 col-xs-12 text-center']);
            $str .= $this->getEntertainerTitle($userData);
        $str .= Html::endTag('div');
        $str .= Html::beginTag('div', ['class' => 'col-lg-1 col-md-1 col-sm-12 col-xs-12']);
            $str .= $this->getEntertainerPhoto($userData->id);
        $str .= Html::endTag('div');
        $str .= Html::endTag('div');

        return $str;
    }

    public function getEntertainerPhoto($entertainerID) {
//        $entertainerPhotoData = UserPhotos::find()
//                ->where(['user_id' => $entertainerID, 'type' => 'main'])
//                ->one();
//        $userPhoto = Html::img(Yii::getAlias('@root') . '/common/uploads/' . $entertainerPhotoData['id'] . '/main/' . $entertainerPhotoData['photo'], []);
        $userPhoto = Html::img('@web/images/Layer.jpg', ['class' => 'img-circle entertainer-dashboard-photo pull-right']);
        return $userPhoto;
    }

    public function getEntertainerTitle($userData) {
        $entertainerData = Entertainer::find()->where(['user_id'=>$userData->id])->one();
        $str = Html::beginTag('h1', ['class' => 'entertainer-dashboard-title']);
        $str .= 'Welcome, ';
        $str .= $entertainerData['name'];
        $str .= Html::endTag('h1');

        return $str;
    }

    private function getEntertainerStaffOrders($userID){
        $entertainerOrders = $this->getPendingOrders($userID);
        $entertainer = Entertainer::find()->where(['user_id'=>$userID])->one();
        $entertainerID = $entertainer['id'];
        if(!empty($entertainerOrders)) {
            $pendingOrders = [];
            foreach($entertainerOrders as $order){
                $pendingOrders[$order['id']] = $order;
            }
            $query = "
                SELECT * FROM tbl_entertainer_orders_staff 
                WHERE entertainer_staff_id IN(SELECT id FROM tbl_entertainer_staff WHERE entertainer_id = ".$entertainerID.")
            ";
            $result = Yii::$app->db->createCommand($query)->queryAll();
            $orderStaff = [];
            foreach($result as $res) {
                if(isset($pendingOrders[$res['entertainer_order_id']])) {
                    $orderStaff[$res['entertainer_staff_id']][] = $pendingOrders[$res['entertainer_order_id']];
                }
            }

            $busyScheduleQuery = "
                    SELECT * FROM tbl_entertainer_busy_schedule 
                    WHERE entertainer_id IN(SELECT id FROM tbl_entertainer WHERE user_id=".$userID.") AND order_id = 0";
            $busyScheduleResult = Yii::$app->db->createCommand($busyScheduleQuery)->queryAll();

            $schedules = [];
            foreach($busyScheduleResult as $schedule){
                $schedules[$schedule['id']] = $schedule;
            }

            $busyScheduleStaffQuery = "
                SELECT * FROM tbl_entertainer_busy_schedule_staff 
                WHERE entertainer_staff_id IN(SELECT id FROM tbl_entertainer_staff WHERE entertainer_id = ".$entertainerID.")
            ";
            $busyScheduleStaffResult = Yii::$app->db->createCommand($busyScheduleStaffQuery)->queryAll();
            $scheduleStaff = [];
            foreach($busyScheduleStaffResult as $res) {
                $scheduleStaff[$res['entertainer_staff_id']][] = $schedules[$res['busy_schedule_id']];
            }

            foreach($orderStaff as $staffID => $orderData) {
                $orderStaff[$staffID] = array_merge($orderData,$scheduleStaff[$staffID]);
            }

            //out($scheduleStaff);
            //out($orderStaff);die;
            //$staff = array_merge_recursive($orderStaff, $scheduleStaff);
            return $orderStaff;
        }
    }

    public function getPendingOrders($userID){
        $query = "
            SELECT
            orders.id AS order_id,
            orders.status,
            entertainer_orders.id,
            entertainer_orders.event_date,
            entertainer_orders.start_time,
            entertainer_orders.end_time,
            (SELECT name FROM tbl_party_type WHERE id = entertainer_orders.party_type_id) AS party_type_name,
            entertainer_orders.host_child_name,
            entertainer_orders.price,
            entertainer_orders.venue_address,
            entertainer_orders.city,
            entertainer.id AS entertainer_id
            FROM tbl_orders orders
            JOIN tbl_entertainer_orders entertainer_orders ON orders.id = entertainer_orders.order_id
            JOIN tbl_entertainer entertainer ON entertainer_orders.entertainer_id = entertainer.id
            WHERE entertainer_orders.status='Pending' AND entertainer_orders.info_status IN('Unacknowledged','Acknowledged') AND entertainer.user_id = ".intval($userID)."
        ";
        return Yii::$app->db->createCommand($query)->queryAll();
    }

    public function drawContent($userData) {
        $userID = $userData->id;
        $entertainerOrders = $this->getPendingOrders($userID);
        $staff = $this->getEntertainerStaffOrders($userID);
        $entertainerEnquiries = $this->getEnquiries($userID);
        return $this->render('/entertainers/account/content', ['entertainerOrders'=>$entertainerOrders,'staff'=>$staff, 'entertainerEnquiries' => $entertainerEnquiries]);
    }

    public function getOrderDetails($orderID){
        $query = "
            SELECT 
                (SELECT name FROM tbl_party_type WHERE id = entertainer_orders.party_type_id) AS party_type_name,
                entertainer_orders.host_child_name
            FROM tbl_orders orders
            INNER JOIN tbl_entertainer_orders entertainer_orders ON orders.id = entertainer_orders.order_id
            WHERE orders.id = ".$orderID."
        ";
        $result = Yii::$app->db->createCommand($query)->queryOne();
        $str = $result['party_type_name'].' '.$result['host_child_name'].' ';
        //$str .= Html::beginTag('span',['class'=>'glyphicon glyphicon-eye-open order-details','data-order-id'=>$orderID,'style'=>'cursor:pointer;']);
        //$str .= Html::endTag('span');
        $str .= Html::beginTag('span',['class'=>'order-details','data-order-id'=>$orderID,'style'=>'cursor:pointer;color:#337ab7;']);
            $str .= 'Go to Order';
        $str .= Html::endTag('span').'  ';
        /*$str .= Html::beginTag('span',['class'=>'make-order','data-order-id'=>$orderID,'style'=>'cursor:pointer;color:#a94442;']);
            $str .= 'Make Notes';
        $str .= Html::endTag('span').' ';
        $str .= Html::beginTag('span',['class'=>'accept-order','data-order-id'=>$orderID,'style'=>'cursor:pointer;color:#a94442;']);
            $str .= 'Acknowledge';
        $str .= Html::endTag('span');*/
        return $str;
    } 

    public function drawOrders($entertainerID) {
        $serviceTypeOrders = EntertainerOrderPrices::find()
                ->select([
                    'tbl_entertainer_order_prices.order_id AS order_id',
                    'tbl_services.name AS service_name',
                    'tbl_entertainer_services.duration AS service_duration',
                    'tbl_entertainer_services.price AS service_price',
                    'tbl_entertainer_services.count_of_guests',
                    'tbl_orders.customer_id AS customer_id',
                    'tbl_orders.entertainer_id AS entertainer_id',
                    'tbl_entertainer_orders.entertainer_package_id AS entertainer_package_id',
                    'tbl_orders.venue_id AS venue_id',
                    'tbl_entertainer_orders.event_date AS event_date',
                    'tbl_entertainer_orders.start_time AS start_time',
                    'tbl_entertainer_orders.end_time AS end_time',
                    'tbl_entertainer_orders.special_requests AS special_request',
                    'tbl_orders.status AS status',
                    'tbl_entertainer_orders.price AS price',
                    'tbl_entertainer_orders.price_type AS price_type',
                    'tbl_entertainer_orders.venue_address'
                ])
                ->leftJoin('tbl_orders', 'tbl_entertainer_order_prices.order_id = tbl_orders.id')
                ->leftJoin('tbl_entertainer_orders', 'tbl_orders.id = tbl_entertainer_orders.order_id')
                ->leftJoin('tbl_entertainer_services', 'tbl_entertainer_services.id = tbl_entertainer_order_prices.entertainer_service_id')
                ->leftJoin('tbl_services', 'tbl_entertainer_services.service_id = tbl_services.id')
                ->where(['tbl_entertainer_order_prices.entertainer_id' => $entertainerID, 'tbl_entertainer_orders.price_type' => 'service'])
                ->asArray()
                ->all();
        
        $packageTypeOrders = Orders::find()
                ->select([
                    'tbl_orders.id AS order_id',
                    'tbl_orders.customer_id AS customer_id',
                    'tbl_orders.entertainer_id AS entertainer_id',
                    'tbl_entertainer_orders.entertainer_package_id AS entertainer_package_id',
                    'tbl_orders.venue_id AS venue_id',
                    'tbl_entertainer_orders.event_date AS event_date',
                    'tbl_entertainer_orders.start_time AS start_time',
                    'tbl_entertainer_orders.end_time AS end_time',
                    'tbl_entertainer_orders.special_requests AS special_request',
                    'tbl_orders.status AS status',
                    'tbl_orders.price AS price',
                    'tbl_entertainer_orders.price_type AS price_type',
                    'tbl_entertainer_orders.venue_address',
                    'tbl_entertainer_packages.price AS entertainer_package_price',
                    'tbl_entertainer_packages.name AS entertainer_package_name'
                ])
                ->leftJoin('tbl_entertainer_orders', 'tbl_orders.id = tbl_entertainer_orders.order_id')
                ->leftJoin('tbl_entertainer_packages', 'tbl_entertainer_packages.id = tbl_entertainer_orders.entertainer_package_id')
                ->where(['price_type' => 'package'])
                ->asArray()
                ->all();
        $ordersArray = [];
        foreach ($serviceTypeOrders AS $order) {
            $ordersArray[$order['order_id']][] = $order;
        }

        foreach ($packageTypeOrders AS $order) {
            $ordersArray[$order['order_id']][] = $order;
        }

        // \yii\helpers\VarDumper::dump($ordersArray, 10, true);die;
        
        $str = '';
        foreach ($ordersArray as $orderData) {
            $str .= Html::beginTag('div', ['style' => 'margin-bottom: 25px;']);
            $str .= Html::beginTag('h4', ['style' => 'margin-bottom: 25px;', 'class' => 'entertainer-dashboard-order-title']);
            $str .= $order['event_date'] . ' | ' . $order['start_time'] . '-' . $order['end_time'];
            $str .= Html::endTag('h4');
            if(!empty($orderData[0]['venue_address'])) {
                $str .= Html::beginTag('h4',['style'=>'font-weight:bold;']);
                    $str .= $orderData[0]['venue_address'];
                $str .= Html::endTag('h4');
            }
            
            if ($orderData[0]['special_request']) {
                $str .= Html::beginTag('h4', ['class' => 'entertainer-dashboard-order-title']);
                $str .= 'Special requests';
                $str .= Html::endTag('h4');
                $str .= Html::beginTag('p', ['style' => 'margin-bottom: 35px;']);
                $str .= $orderData[0]['special_request'];
                $str .= Html::endTag('p');
            }

            $totalPrice = 0;
            $entertainerServicesCount = 0;
            foreach ($orderData as $order) {
                $entertainerServicesCount++;
                $orderID = $order['order_id'];
                $str .= Html::beginTag('h4', ['class' => 'entertainer-dashboard-order-title', 'style' => 'margin-top: 30px;']);
                    $str .= (isset($order['service_name'])) ? $order['service_name'] : '';
                $str .= Html::endTag('h4');
                $str .= Html::beginTag('h4', ['style' => 'margin-bottom: 25px;']);
                    $str .= 'Guests:';
                $str .= (!empty($order['count_of_guests'])) ? $order['count_of_guests'] : '';
                $str .= Html::endTag('h4');
                
                if (!empty($order['service_price'])) {
                    $str .= Html::beginTag('h4');
                    $str .= 'Price: ';
                    $str .= (isset($order['service_price'])) ? '£ '.$order['service_price'] : '';
                    $str .= Html::endTag('h4');
                }

                if ($order['entertainer_package_id']) {
                    $totalPrice = $order['entertainer_package_price'];
                    $entertainerPackageName = $order['entertainer_package_name'];
                } else {
                    //out($order);
                    $totalPrice += (!empty($order['service_price'])) ? $order['service_price'] : 0;
                }
                if (count($orderData) != $entertainerServicesCount) {
                    $str .= Html::beginTag('hr', ['class' => 'dotted-line']);
                }
            }
            
            
            $str .= Html::beginTag('hr', ['class' => 'solid-line']);
            $str .= Html::beginTag('h4');
            $str .= 'Total price: ';
            $str .= $totalPrice;
            if (isset($entertainerPackageName)) {
                $str .= ' (' . $entertainerPackageName . ')';
            }
            $str .= Html::endTag('h4');
            if ($order['status'] == 'Pending') {
                $str .= Html::beginTag('div', ['class' => 'row']);
                    $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2 col-sm-12 col-xs-12']);
                        $str .= Html::beginTag('div', ['class' => 'form-group']);
                        $str .= Html::button('Accept', ['class' => 'btn btn-primary entertainer_accept_btn', 'order_id' => $orderID]);
                        $str .= Html::endTag('div');
                        $str .= Html::endTag('div');
                        $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2 col-sm-12 col-xs-12']);
                        $str .= Html::beginTag('div', ['class' => 'form-group']);
                        $str .= Html::button('Decline', ['class' => 'btn btn-danger entertainer_decline_btn', 'order_id' => $orderID]);
                        $str .= Html::endTag('div');
                    $str .= Html::endTag('div');
                $str .= Html::endTag('div');
            } elseif ($order['status'] == 'Canceled') {
                $str .= Html::beginTag('div', ['class' => 'row']);
                $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2 col-sm-12 col-xs-12']);
                $str .= 'Canceled';
                $str .= Html::endTag('div');
                $str .= Html::endTag('div');
            } elseif ($order['status'] == 'Approved') {
                $str .= Html::beginTag('div', ['class' => 'row']);
                $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2 col-sm-12 col-xs-12']);
                $str .= 'Approved';
                $str .= Html::endTag('div');
                $str .= Html::endTag('div');
            }
            $str .= Html::endTag('div');
        }
        return $str;
    }

    function getTextColor($reason) {
        switch($reason){
            case 1:
                return '#000;';
            case 2:
                return '#fff;';
            case 3:
                return '#000;';
            case 4:
                return '#000;';
        }
    }
    function getName($reason){
        switch($reason){
            case 1:
                return 'Jolly Rex order';
            case 2:
                return 'Unavailable';
            case 3:
                return 'Blocked for Jolly Rex client';
            case 4:
                return 'External order';
            case 5:
                return 'Sick leave';
            case 6:
                return 'Away on holiday';
        }
    }
    function getColor($reason){
        switch($reason){
            case 1:
                //return '#85bbe8';
                return '#3da9c0';
            case 2:
                return '#1B4D3E';
            case 3:
                return 'orange';
            case 4:
                //return '#00FFEF';
                return '#ff9900';
        }
    }

    public function getEnquiries($userID) {
        $query = "
            SELECT 
            entertainer_enquiries.id,
            entertainer_enquiries.option1_date,
            entertainer_enquiries.option1_start_time,
            entertainer_enquiries.option1_end_time,
            entertainer_enquiries.option2_date,
            entertainer_enquiries.option2_start_time,
            entertainer_enquiries.option2_end_time,
            entertainer_enquiries.option3_date,
            entertainer_enquiries.option3_start_time,
            entertainer_enquiries.option3_end_time,
            (SELECT name FROM tbl_party_type WHERE id = entertainer_enquiries.party_type_id) AS party_type_name,
            entertainer_enquiries.entertainers_count,
            entertainer_enquiries.host_child_name,
            entertainer_enquiries.host_child_age,
            entertainer_enquiries.host_child_gender,
            entertainer_enquiries.special_requests,
            entertainer_enquiries.city,
            entertainer_enquiries.price,
            entertainer_enquiries.status,
            entertainer_enquiries.first_line_address,
            entertainer_enquiries.post_code,
            entertainer_enquiries.area,
            entertainer_enquiries.city,
            entertainer_enquiries.order_id
            FROM tbl_entertainer_enquiries entertainer_enquiries
            JOIN tbl_entertainer entertainer ON entertainer_enquiries.entertainer_id = entertainer.id
            WHERE entertainer.user_id = ".intval($userID)."
            ORDER BY entertainer_enquiries.id DESC
        ";
        return Yii::$app->db->createCommand($query)->queryAll();
    }

}
