<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use common\models\Entertainer;
use common\models\EntertainerSearch;
use common\models\UserPhotos;
use common\models\Reviews;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\Orders;
use common\models\entertainer\EntertainerOrders;
use common\models\venue\VenueOrders;
use common\models\entertainer\EntertainerOrderPrices;
use common\models\UserTypes;
use common\models\entertainer\EntertainerPartyThemes;
use yii2fullcalendar\models\Event;
use yii\helpers\ArrayHelper;
use common\models\entertainer\EntertainerServices;
use common\models\entertainer\EntertainerPackages;
use common\models\entertainer\EntertainerBusySchedule;
use common\models\entertainer\EntertainerStaff;
use common\models\entertainer\EntertainerOrdersStaff;
use common\models\entertainer\EntertainerBusyScheduleStaff;
use common\models\PartyType;
use kartik\time\TimePicker;
use yii\helpers\Html;
use yii\helpers\Json;
use common\models\entertainer\EntertainerPostalCodes;
use frontend\components\EntertainerScheduleWidget;
use common\models\entertainer\EntertainerEnquiries;
use common\models\entertainer\EntertainerEnquiryPrices;
use common\models\entertainer\EntertainerBranches;
use common\models\entertainer\EntertainerEnquiryNotifications;
use common\models\entertainer\EntertainerOrderNotifications;

/**
 * Site controller
 */
class EntertainersController extends Controller {

    const ENTERTAINER_TYPE = 2;
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        
        $orderData = [];
        if(Yii::$app->user->identity){
            $customerID = Yii::$app->user->identity->id;
            $orderData = Orders::find()->where(['customer_id'=>$customerID])->limit(1)->one();
        }
        
        $searchModel = new EntertainerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy('rating DESC');
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'orderData'=>$orderData
        ]);
    }

    /**
     * draws enteartainer external page
     */
    public function actionPage($id, $mode  = '') {
        $customerID = (Yii::$app->user->identity) ? Yii::$app->user->identity->id : 0;
        $entertainerPartyThemes = new EntertainerPartyThemes();
        $editOptions = [];
        if($mode){
            $entertainerOrders = new EntertainerOrders();
            $venueOrders = new VenueOrders();
            $entertainerOrderPrices = new EntertainerOrderPrices();
            $entertainerServices = new EntertainerServices();
            if($customerID > 0){
                $orderData = $entertainerOrders->getActiveOrder($customerID, $id);
                $venueOrderData = $venueOrders->getActiveOrder($customerID, $id);
            }
            $entertainerOrderThemePrices = $entertainerOrderPrices->getOrderServices($orderData['id'],'theme');
            $entertainerOrderAdditionalServicePrices = $entertainerOrderPrices->getOrderServices($orderData['id'],'additional_service');
            $entertainerPriceData = $entertainerServices->getEntertainerServiceData($orderData['theme_service_id'], $id);
            
            $editOptions = [
                'entertainerOrderPrices' => $entertainerOrderPrices,
                'entertainerPriceData' => $entertainerPriceData,
                'entertainerOrderThemePrices' => $entertainerOrderThemePrices,
                'entertainerOrderAdditionalServicePrices' => $entertainerOrderAdditionalServicePrices,
                'orderData' => $orderData,
                'venueOrderData' => $venueOrderData
            ];
        }
        
        $entertainerData = Entertainer::findOne($id);
        $entertainerStaff = Entertainer::getEntertainerStaff($id);
        
        $entertainerPartyThemes = $entertainerPartyThemes->getPartyThemeList($id);
        $supplierReviews = Reviews::find()->where(['supplier_id' => $id])->asArray()->all();
        $customerOwnReview = Reviews::find()->where(['customer_id'=>$customerID,'supplier_id' => $id])->asArray()->one();
        return  $this->render('page', [
                    'entertainerID'=>$id,
                    'entertainerStaff' => $entertainerStaff,
                    'userData' => $entertainerData,
                    'entertainerPartyThemes' => $entertainerPartyThemes,
                    'supplierReviews' => $supplierReviews,
                    'customerOwnReview' => $customerOwnReview,
                    'mode'=>$mode
            ]+$editOptions);
    }

    /**
     *  gives feedback to entertainer 
     */
    public function actionGiveFeedbackEntertainer() {
        $entertainerID = Yii::$app->request->post('entertainer_id');
        $comment = Yii::$app->request->post('comment');
        $reviews = new Reviews();
        $reviews->customer_id = Yii::$app->user->identity->id;
        $reviews->supplier_id = $entertainerID;
        $reviews->comment = $comment;
        echo ($reviews->save()) ? 1 : 0;
    }

    /**
     * gets busy schedule for given entertainer
     * 'entertainer_id' integer
     * 'date' date
     */
    public function actionGetBusySchedule() {
        $entertainerID = Yii::$app->request->post('entertainer_id');
        $date = Yii::$app->request->post('date');
        $busySchedule = EntertainerBusySchedule::find()->where(['entertainer_id'=>$entertainerID,'busy_date'=>$date])->asArray()->all();
        $str = '';
        foreach($busySchedule as $item) {
            $str .= Html::beginTag('tr',[]);
                if($item['busy_start_time'] != '' && $item['busy_end_time'] != ''){
                    $str .= Html::beginTag('td');
                        $str .= $item['busy_start_time'].' - '.$item['busy_end_time'];
                    $str .= Html::endTag('td');
                }else{
                    $str .= Html::beginTag('td');
                        $str .= 'Hall day is busy';
                    $str .= Html::endTag('td');
                }
            $str .= Html::endTag('tr');
        }
        ob_start();
            echo $str;
        return ob_get_clean();
    }

    /**
     * resereves schedule for supplier
     */
    public function actionReserveSchedule() {
        if(Yii::$app->request->isAjax) {
            $post = $_POST;
            $entertainerStaffIDs = Json::decode($post['entertainer_staff']);
            $model = new EntertainerBusySchedule();
            $entertainerBusyScheduleStaff = new EntertainerBusyScheduleStaff();

            $allDayChecked = (bool)$post['all_day_checked'];

            if($allDayChecked){
                $model->entertainer_id = $post['entertainer_id'];
                $model->busy_date = $post['busy_date'];
            }else {
                $model->entertainer_id = $post['entertainer_id'];
                $model->busy_date = $post['busy_date'];
                $model->busy_start_time = $post['busy_start_time'];
                $model->busy_end_time = $post['busy_end_time'];
            }
            $model->reason = $post['block_reason'];
            $model->save();
            $busyScheduleID = Yii::$app->db->getLastInsertID();
            foreach($entertainerStaffIDs as $staffID){
                $entertainerBusyScheduleStaff->busy_schedule_id = $busyScheduleID;
                $entertainerBusyScheduleStaff->entertainer_staff_id = $staffID;
            }
            $entertainerBusyScheduleStaff->save();
            ob_start();
                echo Json::encode(EntertainerBusySchedule::findOne($model->id));
            return ob_get_clean();
        }
    }

    /**
     * unblocks entertainers blocked schedule
     */
    public function actionGetBlockedScheduleTable() {
        if(Yii::$app->request->isAjax) {
            $entertainerID = Yii::$app->request->post('entertainer_id');
            $staffID = Yii::$app->request->post('staff_id');
            $query = "
                SELECT 
                entertainer_busy_schedule.id AS busy_schedule_id,
                entertainer_busy_schedule.entertainer_id,
                entertainer_busy_schedule.busy_date,
                entertainer_busy_schedule.busy_start_time,
                entertainer_busy_schedule.busy_end_time,
                entertainer_busy_schedule_staff.entertainer_staff_id,
                CONCAT_WS(' ',entertainer_staff.first_name,entertainer_staff.last_name) AS entertainer_staff_name
                FROM tbl_entertainer_busy_schedule entertainer_busy_schedule
                INNER JOIN tbl_entertainer_busy_schedule_staff entertainer_busy_schedule_staff ON entertainer_busy_schedule.id = entertainer_busy_schedule_staff.busy_schedule_id
                INNER JOIN tbl_entertainer_staff entertainer_staff ON entertainer_busy_schedule_staff.entertainer_staff_id = entertainer_staff.id
                WHERE entertainer_busy_schedule.entertainer_id = ".intval($entertainerID)." AND entertainer_busy_schedule_staff.entertainer_staff_id = ".intval($staffID)."
            ";
            $busyScheduleRowsForStaff = Yii::$app->db->createCommand($query)->queryAll();
            $str = Html::beginTag('table',['class'=>'table table-borderless']);
            foreach($busyScheduleRowsForStaff as $busyScheduleRow) {

                $busyScheduleID = $busyScheduleRow['busy_schedule_id'];
                $busyDate = $busyScheduleRow['busy_date'];
                $busyStartTime = $busyScheduleRow['busy_start_time'];
                $busyEndTime = $busyScheduleRow['busy_end_time'];
                $entertainerStaffName = $busyScheduleRow['entertainer_staff_name'];

                $busyDateObj = new \DateTime($busyDate);
                $newBusyDate = $busyDateObj->format('l, F d, Y');
                $busyStartTimeObj = new \DateTime($busyStartTime);
                $newBusyStartTime = $busyStartTimeObj->format('H:i');
                $busyEndTimeObj = new \DateTime($busyEndTime);
                $newEndTime = $busyEndTimeObj->format('H:i');


                $str .= Html::beginTag('tr');
                    $str .= Html::beginTag('td');
                        $str .= Html::checkbox('', false, ['labelOptions' => ['style' => 'padding:5px;'], 'class' => 'blocked-schedule-class', 'style'=>'width: 18px;height: 18px;','value'=>$busyScheduleID]);
                    $str .= Html::endTag('td');
                    $str .= Html::beginTag('td');
                        $str .= $newBusyDate;
                    $str .= Html::endTag('td');
                    $str .= Html::beginTag('td');
                        $str .= $newBusyStartTime;
                    $str .= Html::endTag('td');
                    $str .= Html::beginTag('td');
                        $str .= $newEndTime;
                    $str .= Html::endTag('td');
                    $str .= Html::beginTag('td');
                        $str .= $entertainerStaffName;
                    $str .= Html::endTag('td');
                $str .= Html::endTag('tr'); 
            }
            $str .= Html::beginTag('tr');
                $str .= Html::beginTag('td',['colspan'=>5]);
                    $str .= Html::beginTag('button',['class'=>'btn btn-success unblock-schedule-class pull-right']);
                        $str .= 'Unblock';
                    $str .= Html::endTag('button');
                $str .= Html::endTag('td');
            $str .= Html::endTag('tr');
            $str .= Html::endTag('table');
            ob_start();
                echo $str;
            return ob_get_clean();
        }
    }

    /**
     * unblocks entertainers blocked schedule tested only unavailable
     */
    public function actionUnblockSchedule() {
        if(Yii::$app->request->isAjax) {
            $ids = Json::decode(Yii::$app->request->post('busy_schedule_ids'));
            $idString = implode(',',$ids);
            $query = "DELETE FROM tbl_entertainer_busy_schedule_staff WHERE busy_schedule_id IN(".$idString.")";
            $result = Yii::$app->db->createCommand($query)->execute();
            if($result) {
                foreach($ids as $id){
                    $model = EntertainerBusySchedule::findOne($id);
                    $model->delete();
                }
            }
            echo 1;
        }
    }

    public function actionGetPriceTableByType() {
        if(Yii::$app->request->isAjax) {
            $entertainerID = Yii::$app->request->post('entertainer_id');
            $type = Yii::$app->request->post('type');
            $entertainerData = Entertainer::findOne($entertainerID);
            $str = '';
            if($type == 'service') {
                $description = $entertainerData->price_description;
                $entertainerPriceData = EntertainerServices::find()->where(['entertainer_id'=>$entertainerID])->all();
                $str .= $this->renderAjax('_services', [
                    'entertainerPriceData' => $entertainerPriceData,
                    'orderModel' => null,
                ]);
            }elseif($type == 'package') {
                $description = $entertainerData->package_description;
                $entertainerPackageData = EntertainerPackages::find()->where(['entertainer_id'=>$entertainerID])->all();
                $str .= $this->renderAjax('_packages', [
                    'entertainerPackageData' => $entertainerPackageData,
                    'orderModel' => null
                ]);
            }
            $result = ['table_html'=>$str,'description_html'=>$description];
            ob_start();
                echo Json::encode($result);
            return ob_get_clean();
        }
    }

    public function actionGetPriceTableByTheme(){
        //@TODO
        if(Yii::$app->request->isAjax) {
            $entertainerID = Yii::$app->request->post('entertainer_id');
            $partyThemeID = Yii::$app->request->post('party_theme_id');
            $entertainersCount = Yii::$app->request->post('entertainers_count');
            $entertainerData = Entertainer::findOne($entertainerID);
            $description = $entertainerData->price_description;
            $entertainerServices = new EntertainerServices();
            $entertainerPriceData = $entertainerServices->getEntertainerServiceData($partyThemeID, $entertainerID, $entertainersCount);
            $str = $this->renderAjax('_prices_by_theme', [
                'entertainerPriceData' => $entertainerPriceData,
            ]);
            $result = ['table_html'=>$str,'description_html'=>$description];
            ob_start();
                echo Json::encode($result);
            return ob_get_clean();
        }
    }

    //get-price-table-by-additional-service
    public function actionGetPriceTableByAdditionalService(){
        if(Yii::$app->request->isAjax) {
            $entertainerID = Yii::$app->request->post('entertainer_id');
            $partyThemeID = Yii::$app->request->post('party_theme_id');
            $entertainerServices = new EntertainerServices();
            $entertainerPriceData = $entertainerServices->getEntertainerAdditionalServiceData($partyThemeID, $entertainerID);
            $str = $this->renderAjax('_prices_by_additional_services', [
                'entertainerPriceData' => $entertainerPriceData,
            ]);
            $result = ['table_html'=>$str];
            ob_start();
                echo Json::encode($result);
            return ob_get_clean();
        }
    }

    /**
     * saves the order
     */
    public function actionSaveOrder() {
        if(Yii::$app->request->isAjax) {
            $data = $_POST;
            $orderID = $data['order_id'];
            $entertainerID = $data['entertainer_id'];
            $customerID = Yii::$app->user->identity->id;
            $partyTypeID = $data['party_type_id'];
            $themeServiceID = $data['theme_service_id'];
            $additionalServiceID = $data['additional_service_id'];
            $eventDate = $data['event_date'];
            $startTime = $data['start_time'];
            $endTime = $data['end_time'];
            $totalPrice = $data['total_price'];
            $specialRequest = $data['special_request'];
            $themeServices = Json::decode($_POST['theme_services']);
            $additionalServices = Json::decode($_POST['additional_services']);
            $hostChildAge = $data['host_child_age'];
            $hostChildGender = $data['host_child_gender'];
            $telephoneNumber = $data['telephone_number'];
            $hostChildNumber = $data['host_child_name'];
            $entertainersCount = $data['entertainers_count'];

            $orderModel = Orders::findOne($orderID);
            //$orderModel->food_id = NULL;
            //$orderModel->save();die;
            $entertainerModel = EntertainerOrders::find()->where(['order_id'=>$orderID,'entertainer_id'=>$entertainerID])->one();
            // $entertainerModel->city = '';
            // $entertainerModel->save();die;
            //out($orderModel);
            //out($entertainerModel);

            out($themeServices);

            //$postedPriceSetupIDs = array_map(function($item){return $item['price_setup_id'];}, $themeServices);
            //$postedExtraBaseCount = array_map(function($item){return $item['extra_guests_count'];}, $themeServices);

            $entertainerOrderPrices = EntertainerOrderPrices::find()->select(['tbl_entertainer_order_prices.id','extra_guest_count'])->where(['entertainer_id'=>$entertainerID,'order_id'=>$orderID,'service_type'=>'theme'])->all();
            out($entertainerOrderPrices);
            
        }
    }

    public function actionUpdateVenueManuallyInOrder(){
        $data = $_POST;
        $orderID = $data['id'];
        $entertainerOrdersModel = EntertainerOrders::find()->where(['order_id'=>$orderID])->one();
        $entertainerOrdersModel->venue_address = $data['venue_address'];
        $entertainerOrdersModel->post_code = $data['post_code'];
        $entertainerOrdersModel->city = $data['city'];
        $entertainerOrdersModel->save();
        echo 1;
    }

    public function actionGetAdditionalServicePriceTableByOptions() {
        if(Yii::$app->request->isAjax) {
            $data = $_POST;
            $priceData = EntertainerServices::getServicePrice($data);
            echo Json::encode($priceData);
        }
    }

    /**
     * gets geo areas of given entertainer
     */
    public function actionGetGeoAreas(){
        if(Yii::$app->request->isAjax) {
            $entertainerID = Yii::$app->request->post('entertainer_id');
            $entertainerPostalCodes = new EntertainerPostalCodes;
            $entertainerPostalCodesData = $entertainerPostalCodes->getEntertainerPostalCodeData(['entertainer_id'=>$entertainerID]);
            // out($entertainerPostalCodesData);
            echo Json::encode($entertainerPostalCodesData);
        }
    }

    /**
     * draws enteartainer external page
     */
    public function actionBook($id) {
        $customerID = (Yii::$app->user->identity) ? Yii::$app->user->identity->id : 0;
        $entertainerPartyThemes = new EntertainerPartyThemes();
        $entertainerServices = new EntertainerServices();
        $entertainerData = Entertainer::findOne($id);
        //out($entertainerData);
        $entertainerStaff = Entertainer::getEntertainerStaff($id);
        $entertainerPartyThemes = $entertainerPartyThemes->getPartyThemeList($id);
        $supplierReviews = Reviews::find()->where(['supplier_id' => $id,'admin_id'=>0])->andWhere(['<>','entertainers_point', ''])->asArray()->all();
        $adminReviews = Reviews::find()->where(['supplier_id' => $id,'admin_id'=>1])->all();
        $orderData = Orders::find()->where(['customer_id'=>$customerID,'status'=>'active','entertainer_id'=>0])->all();
        $entertainerPostalCodes = new EntertainerPostalCodes;
        $entertainerPostalCodesData = $entertainerPostalCodes->getEntertainerPostalCodeData(['entertainer_id'=>$id]);
        $entertainerBranchesData = EntertainerBranches::find()->where(['entertainer_id'=>$id])->all();
        $entertainerExtraThemeServices = $entertainerServices->getEntertainerExtraThemesServiceData($id);
        $entertainerAdditionalProductsServices = $entertainerServices->getEntertainerAdditionalProductsServices($id);
        return  $this->render('book/index', [
                    'entertainerID'=>$id,
                    'entertainerStaff' => $entertainerStaff,
                    'userData' => $entertainerData,
                    'entertainerData' => $entertainerData,
                    'entertainerPartyThemes' => $entertainerPartyThemes,
                    'supplierReviews' => $supplierReviews,
                    'adminReviews' => $adminReviews,
                    'orderData' => $orderData,
                    'geoLocations' => $entertainerPostalCodesData,
                    'entertainerBranchesData' => $entertainerBranchesData,
                    'entertainerExtraThemeServices' => $entertainerExtraThemeServices,
                    'entertainerAdditionalProductsServices' => $entertainerAdditionalProductsServices
        ]);
    }

    /**
     * books entertainer
     */
    public function actionBookProcess() {
        $data = $_POST;
        // out($_POST['_csrf']);
        //out($_SESSION);
        //out($data, true);

        $entertainerID = $data['entertainer_id'];
        $supportInstantBooking = (isset($data['support_instant_booking'])) ? $data['support_instant_booking'] : 0;
        $partyTypeID = $data['party_type_id'];
        $themeServiceID = $data['theme_service_id'];
        $additionalServiceID = $data['additional_service_id'];
        $eventDate = $data['event_date'];
        $startTime = $data['start_time'];
        $endTime = $data['end_time'];
        $totalPrice = $data['total_price'];
        $specialRequest = $data['special_requests'];
        $themeServices = Json::decode($_POST['theme_services']);
        $additionalServices = Json::decode($_POST['additional_services']);
        $hostChildAge = $data['host_child_age'];
        $hostChildGender = $data['host_child_gender'];
        $telephoneNumber = $data['telephone_number'];
        $hostChildNumber = $data['host_child_name'];
        //$priceType = $data['price_type'];
        $entertainersCount = $data['entertainers_count'];
        /*if($priceType == 'package') {
            $entertainerPackageID = $data['package_id'];
        }*/
        $orderType = ($supportInstantBooking == 1) ? 'order' : 'enquiry';

        $orders = new Orders();
        $entertainerOrders = new EntertainerOrders();
        $entertainerBusySchedule = new EntertainerBusySchedule();
        $orders->customer_id = Yii::$app->user->identity->id;
        $orders->entertainer_id = $entertainerID;
        $orders->status = 'Unacknowledged';
        $orders->price = $totalPrice;
        $orders->creator_id = Yii::$app->user->identity->id;
        $orders->order_type = $orderType;

        $result = '';
        if($orders->save()){
            $orderID = $orders->id;
            $entertainerOrders->order_id = $orderID;
            $entertainerOrders->entertainer_id = $entertainerID;
            $entertainerOrders->party_type_id = $partyTypeID;
            $entertainerOrders->theme_service_id = $themeServiceID;
            $entertainerOrders->additional_service_id = $additionalServiceID;
            $entertainerOrders->event_date = $eventDate;
            $entertainerOrders->start_time = $startTime;
            $entertainerOrders->end_time = $endTime;
            $entertainerOrders->entertainers_count = $entertainersCount;
            $entertainerOrders->special_requests = $specialRequest;
            $entertainerOrders->price = $totalPrice;
            $entertainerOrders->host_child_age = $hostChildAge;
            $entertainerOrders->host_child_gender = $hostChildGender;
            $entertainerOrders->host_child_name = $hostChildNumber;
            $entertainerOrders->telephone_number = $telephoneNumber;
            $entertainerOrders->status = 'Pending';
            $entertainerOrders->info_status = 'Unacknowledged';
            $entertainerOrders->customer_id = Yii::$app->user->identity->id;
            //$entertainerOrders->price_type = $priceType;
            /*if($priceType == 'package') {
                $entertainerOrders->entertainer_package_id = $entertainerPackageID;
            }*/
            if($entertainerOrders->save(false)) {
                foreach($themeServices as $service) {
                    $orderSetup = new EntertainerOrderPrices();
                    $orderSetup->entertainer_id = $entertainerID;
                    $orderSetup->customer_id = Yii::$app->user->identity->id;
                    $orderSetup->order_id = $orderID;
                    $orderSetup->entertainer_service_id = $service['price_setup_id'];
                    $orderSetup->extra_guest_count = ($service['extra_guests_count']) ? ($service['extra_guests_count']) : 0;
                    $orderSetup->service_type = $service['type'];
                    /*if($priceType == 'service') {
                        $orderSetup->entertainer_service_id = $priceSetupID;
                    }*/
                    $orderSetup->save();
                }

                if(!empty($additionalServices['price_setup_id'])) {
                    $orderSetup = new EntertainerOrderPrices();
                    $orderSetup->entertainer_id = $entertainerID;
                    $orderSetup->customer_id = Yii::$app->user->identity->id;
                    $orderSetup->order_id = $orderID;
                    $orderSetup->entertainer_service_id = $additionalServices['price_setup_id'];
                    $orderSetup->service_type = $additionalServices['type'];
                    $orderSetup->save();
                }
            }

            // if entertainer has only one member
            //when entertainer is being hired then he should be busy at least one hour

            /*$entertainerBusySchedule->busy_date = $eventDate;
            $entertainerBusySchedule->entertainer_id = $entertainerID;
            $entertainerBusySchedule->busy_start_time = $startTime;
            $entertainerBusySchedule->busy_end_time = $endTime;
            $entertainerBusySchedule->reason = EntertainerBusySchedule::BLOCKED_FOR_JOLLY_REX_CLIENT;
            $entertainerBusySchedule->order_id = $orderID;
            //out($entertainerBusySchedule);
            $entertainerBusySchedule->save();*/

            /*$newEndTime = new \DateTime($endTime);
            $newEndTime->add(new \DateInterval('PT1H'));
            $newEndTimeValue = $newEndTime->format('H:i');
            $entertainerBusySchedule->busy_date = $eventDate;
            $entertainerBusySchedule->entertainer_id = $entertainerID;
            $entertainerBusySchedule->busy_start_time = $endTime;
            $entertainerBusySchedule->busy_end_time = $newEndTimeValue;
            $entertainerBusySchedule->save();*/

            $result = $orderID;
        }
        echo $result;
    }

    public function actionAmend($id, $oID) {
        $customerID = (Yii::$app->user->identity) ? Yii::$app->user->identity->id : 0;
        $entertainerPartyThemes = new EntertainerPartyThemes();
        $entertainerOrders = new EntertainerOrders();
        $venueOrders = new VenueOrders();
        $entertainerOrderPrices = new EntertainerOrderPrices();
        $entertainerServices = new EntertainerServices();
        if($customerID > 0){
            $orderData = $entertainerOrders->getActiveOrder($customerID, $id);
            $venueOrderData = $venueOrders->getActiveOrder($customerID, $id);
        }
        $entertainerOrderThemePrices = $entertainerOrderPrices->getOrderServices($orderData['id'],'theme');
        $entertainerOrderAdditionalServicePrices = $entertainerOrderPrices->getOrderServices($orderData['id'],'additional_service');
        $entertainerPriceData = $entertainerServices->getEntertainerServiceData($orderData['theme_service_id'], $id);
        
        $entertainerData = Entertainer::findOne($id);
        $entertainerStaff = Entertainer::getEntertainerStaff($id);
        
        $entertainerPartyThemes = $entertainerPartyThemes->getPartyThemeList($id);
        $supplierReviews = Reviews::find()->where(['supplier_id' => $id])->asArray()->all();
        $customerOwnReview = Reviews::find()->where(['customer_id'=>$customerID,'supplier_id' => $id])->asArray()->one();
        return  $this->render('amend/index', [
                    'entertainerID'=>$id,
                    'entertainerStaff' => $entertainerStaff,
                    'userData' => $entertainerData,
                    'entertainerPartyThemes' => $entertainerPartyThemes,
                    'supplierReviews' => $supplierReviews,
                    'customerOwnReview' => $customerOwnReview,
                    'entertainerOrderPrices' => $entertainerOrderPrices,
                    'entertainerPriceData' => $entertainerPriceData,
                    'entertainerOrderThemePrices' => $entertainerOrderThemePrices,
                    'entertainerOrderAdditionalServicePrices' => $entertainerOrderAdditionalServicePrices,
                    'orderData' => $orderData,
                    'venueOrderData' => $venueOrderData
            ]);
    }

    public function actionGetOrderDetail() {
        if(Yii::$app->request->isAjax) {
            $orderID = Yii::$app->request->post('order_id');
            $entertainerOrders = new EntertainerOrders();
            $result = $entertainerOrders->getDataByOrder($orderID);
            $entertainerStaff = \common\models\entertainer\EntertainerStaff::find()->where(['entertainer_id'=>$result['entertainer_id']])->asArray()->all();
            $result['entertainers'] = $entertainerStaff;
            // out($result);
            echo Json::encode($result);
        }
    }

    /**
     * saves order note
     */
    public function actionSaveOrderNote(){
        if(Yii::$app->request->isAjax) {
            $orderID = Yii::$app->request->post('order_id');
            $note = Yii::$app->request->post('note');
            $entertainerOrders = EntertainerOrders::find()->where(['order_id'=>$orderID])->one();
            $entertainerOrders->note = $note;
            if($entertainerOrders->save()){
                echo 1;
            }
        }
    }

    /**
     * acknoweledges the order
     */
    public function actionAcknowledgeOrder(){
        if(Yii::$app->request->isAjax) {
            $orderID = Yii::$app->request->post('order_id');
            $message = Yii::$app->request->post('message');
            $staff = Json::decode(Yii::$app->request->post('staff')); // keep staff for including it in email

            $order = Orders::findOne($orderID);
            $entertainerOrders = EntertainerOrders::find()->where(['order_id' => $orderID])->one();
            $entertainerOrders->message = $message;
            $entertainerOrders->info_status = 'Acknowledged';
            if($entertainerOrders->save()){
                $order->status = 'Acknowledged';
                $order->save();
                //send an email
                echo 1;
            }
        }
    }

    /**
     * cancels order
     */
    public function actionCancelOrder(){
        if(Yii::$app->request->isAjax) {
            $orderID = Yii::$app->request->post('order_id');
            $message = Yii::$app->request->post('message');

            $order = Orders::findOne($orderID);
            $entertainerOrders = EntertainerOrders::find()->where(['order_id' => $orderID])->one();
            $entertainerOrders->message = $message;
            $entertainerOrders->info_status = 'Cancelled';
            if($entertainerOrders->save()){
                $order->status = 'Cancelled';
                $order->save();
                //send an email
                echo 1;
            }
        }
    }

    public function actionBusyScheduleForm(){
        if(Yii::$app->request->isAjax){
            $id = Yii::$app->request->post('id');
            $model = (EntertainerBusySchedule::findOne($id)) ?: (new EntertainerBusySchedule);
            $order = [];
            if($model->order_id > 0) {
                $entertainerOrdersInstance = new EntertainerOrders();
                $order = $entertainerOrdersInstance->getDataByOrder($model->order_id);
                $entertainerOrdersModel = EntertainerOrders::find()->where(['order_id'=>$model->order_id])->one();
                return $this->renderAjax('account/busy-schedule-form',['model'=>$model,'order'=>$order,'entertainerOrdersModel'=>$entertainerOrdersModel]);
            }else{
                return $this->renderAjax('account/busy-schedule-form',['model'=>$model]);
            }
        }
    }

    public function actionSaveSchedule(){
        //out($_SESSION);
        //out($_POST);
        if(Yii::$app->request->isAjax){
            
        }
    }

    public function actionGetBusyScheduleById(){
        if(Yii::$app->request->isAjax){
            $busyScheduleID = Yii::$app->request->post('busy_schedule_id');
            $entertainerBusySchedule = EntertainerBusySchedule::find()->where(['id'=>$busyScheduleID])->asArray()->one();
            $entertainerStaff = EntertainerStaff::find()->where(['entertainer_id'=>$entertainerBusySchedule['entertainer_id']])->asArray()->all();
            $entertainerBusyScheduleStaff = EntertainerBusyScheduleStaff::find()->where(['busy_schedule_id'=>$busyScheduleID])->asArray()->all();
            $entertainerBusyScheduleStaffList = array_map(function($item){return $item['entertainer_staff_id'];},$entertainerBusyScheduleStaff);
            return $this->renderAjax('account/_busy_schedule-edit-unblock-form', [
                                        'entertainerBusySchedule'=>$entertainerBusySchedule,
                                        'entertainerStaff'=>$entertainerStaff,
                                        'entertainerBusyScheduleStaff'=>$entertainerBusyScheduleStaff,
                                        'entertainerBusyScheduleStaffList'=>$entertainerBusyScheduleStaffList
                                    ]);
        }
    }

    public function actionScheduleSearch(){
        if(Yii::$app->request->isAjax) {
            $year = date('Y');
            $entertainerID = Yii::$app->request->post('entertainer_id');
            $month = Yii::$app->request->post('month');
            $week = Yii::$app->request->post('week');
            $day = Yii::$app->request->post('day');
            $staff = Json::decode(Yii::$app->request->post('staff'));
            return EntertainerScheduleWidget::widget(['entertainerID' => $entertainerID, 'year' => $year, 'month' => $month,'week'=>$week,'day' => $day, 'type'=>'All','entertainer'=>$staff]);
        }
    }

    public function actionTestCrop() {
        $im = imagecreatefrompng('../web/images/account-figure-1.png');
        $size = min(imagesx($im), imagesy($im));
        $im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => 1500, 'height' => 1500]);
        if ($im2 !== FALSE) {
            imagepng($im2, 'example-cropped.png');
            imagedestroy($im2);
        }
        imagedestroy($im);
        var_dump('ok');die;
    }

    /**
     * draws enteartainer external page
     */
    public function actionEnquiry($id) {
        $customerID = (Yii::$app->user->identity) ? Yii::$app->user->identity->id : 0;
        $entertainerPartyThemes = new EntertainerPartyThemes();
        $entertainerServices = new EntertainerServices();
        $entertainerData = Entertainer::findOne($id);
        $entertainerStaff = Entertainer::getEntertainerStaff($id);
        $entertainerPartyThemes = $entertainerPartyThemes->getPartyThemeList($id);
        $entertainerExtraThemeServices = $entertainerServices->getEntertainerExtraThemesServiceData($id);
        $entertainerAdditionalProductsServices = $entertainerServices->getEntertainerAdditionalProductsServices($id);
        $supplierReviews = Reviews::find()->where(['supplier_id' => $id,'admin_id'=>0])->andWhere(['<>','entertainers_point', ''])->asArray()->all();
        $adminReviews = Reviews::find()->where(['supplier_id' => $id,'admin_id'=>1])->all();
        $orderData = Orders::find()->where(['customer_id'=>$customerID,'status'=>'active','entertainer_id'=>0])->all();
        $entertainerPostalCodes = new EntertainerPostalCodes;
        $entertainerPostalCodesData = $entertainerPostalCodes->getEntertainerPostalCodeData(['entertainer_id'=>$id]);
        $entertainerBranchesData = EntertainerBranches::find()->where(['entertainer_id'=>$id])->all();
        return  $this->render('enquiry/index', [
                    'entertainerID'=>$id,
                    'entertainerStaff' => $entertainerStaff,
                    'userData' => $entertainerData,
                    'entertainerData' => $entertainerData,
                    'entertainerPartyThemes' => $entertainerPartyThemes,
                    'supplierReviews' => $supplierReviews,
                    'adminReviews' => $adminReviews,
                    'orderData' => $orderData,
                    'geoLocations' => $entertainerPostalCodesData,
                    'entertainerExtraThemeServices' => $entertainerExtraThemeServices,
                    'entertainerAdditionalProductsServices' => $entertainerAdditionalProductsServices,
                    'entertainerBranchesData' => $entertainerBranchesData
        ]);
    }

    /**
     * makes an enquiry by saving data
     */
    public function actionEnquiryProcess() {
        $entertainerID = Yii::$app->request->post('entertainer_id');
        $model = new EntertainerEnquiries;
        $model->customer_id = Yii::$app->user->identity->id;
        $model->entertainer_id = $entertainerID;
        $model->option1_date = Yii::$app->request->post('option1_date');
        $model->option1_start_time = Yii::$app->request->post('option1_start_time');
        $model->option1_end_time = Yii::$app->request->post('option1_end_time');
        $model->option2_date = Yii::$app->request->post('option2_date');
        $model->option2_start_time = Yii::$app->request->post('option2_start_time');
        $model->option2_end_time = Yii::$app->request->post('option2_end_time');
        $model->option3_date = Yii::$app->request->post('option3_date');
        $model->option3_start_time = Yii::$app->request->post('option3_start_time');
        $model->option3_end_time = Yii::$app->request->post('option3_end_time');
        $model->party_type_id = Yii::$app->request->post('party_type_id');
        $model->price = Yii::$app->request->post('price');
        $model->special_requests = Yii::$app->request->post('special_requests');
        $model->host_child_age = Yii::$app->request->post('host_child_age');
        $model->host_child_gender = Yii::$app->request->post('host_child_gender');
        $model->host_child_name = Yii::$app->request->post('host_child_name');
        $model->entertainers_count = Yii::$app->request->post('entertainers_count');
        $model->first_line_address = Yii::$app->request->post('first_line_address');
        $model->post_code = Yii::$app->request->post('post_code');
        $model->area = Yii::$app->request->post('area');
        $model->city = Yii::$app->request->post('city');
        $model->status = 'to_confirm';
        $model->theme_service_id = Yii::$app->request->post('theme_service_id');
        $model->extra_option = Yii::$app->request->post('extra_option');
        $model->additional_service_id = Yii::$app->request->post('additional_service_id');
        $model->title = Yii::$app->request->post('title');
        $model->name = Yii::$app->request->post('name');
        $model->email = Yii::$app->request->post('email');
        $model->telephone_number = Yii::$app->request->post('telephone_number');
        $model->mobile_number = Yii::$app->request->post('mobile_number');
        $model->price = Yii::$app->request->post('price');
        $themeServices = Json::decode(Yii::$app->request->post('theme_services'));
        $extraServices = Json::decode(Yii::$app->request->post('extra_theme_services'));
        $additionalServices = Json::decode(Yii::$app->request->post('additional_services'));
        $additionalProducts = Json::decode(Yii::$app->request->post('additional_products'));
        if($model->save()) {
            $enquiryID = $model->id;
            foreach($themeServices as $theme) {
                $enquiryPrice = new EntertainerEnquiryPrices();
                $enquiryPrice->entertainer_id = $entertainerID;
                $enquiryPrice->customer_id = Yii::$app->user->identity->id;
                $enquiryPrice->enquiry_id = $enquiryID;
                $enquiryPrice->entertainer_service_id = $theme['price_setup_id'];
                $enquiryPrice->extra_guest_count = ($theme['extra_guests_count']) ? ($theme['extra_guests_count']) : 0;
                $enquiryPrice->service_type = $theme['type'];
                $enquiryPrice->save();
            }

            foreach($extraServices as $extra) {
                $enquiryPrice = new EntertainerEnquiryPrices();
                $enquiryPrice->entertainer_id = $entertainerID;
                $enquiryPrice->customer_id = Yii::$app->user->identity->id;
                $enquiryPrice->enquiry_id = $enquiryID;
                $enquiryPrice->entertainer_service_id = $extra['price_setup_id'];
                $enquiryPrice->extra_guest_count = ($extra['extra_guests_count']) ? ($extra['extra_guests_count']) : 0;
                $enquiryPrice->service_type = $extra['type'];
                $enquiryPrice->save();
            }

            if(!empty($additionalServices['price_setup_id'])) {
                $enquiryPrice = new EntertainerEnquiryPrices();
                $enquiryPrice->entertainer_id = $entertainerID;
                $enquiryPrice->customer_id = Yii::$app->user->identity->id;
                $enquiryPrice->enquiry_id = $enquiryID;
                $enquiryPrice->entertainer_service_id = $additionalServices['price_setup_id'];
                $enquiryPrice->service_type = $additionalServices['type'];
                $enquiryPrice->save();
            }

            foreach($additionalProducts as $product) {
                $enquiryPrice = new EntertainerEnquiryPrices();
                $enquiryPrice->entertainer_id = $entertainerID;
                $enquiryPrice->customer_id = Yii::$app->user->identity->id;
                $enquiryPrice->enquiry_id = $enquiryID;
                $enquiryPrice->entertainer_service_id = $product['price_setup_id'];
                $enquiryPrice->extra_guest_count = 0;
                $enquiryPrice->service_type = $product['type'];
                $enquiryPrice->save();
            }
            echo 1;
        }
    }

    /**
     * get distance between two post codes
     * used Google Maps Distance Matrix API
     */
    public function actionGetDistance() {
        $origin = $_POST['origin']; 
        $destination = $_POST['distance'];
        $entertainerMileagePrice = floatval($_POST['entertainer_mileage_price']);
        $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$origin."&destinations=".$destination."&key=AIzaSyCG_nVwR78B0ZH_AIovqksOjANsEoTfmBQ");
        $data = json_decode($api);
        $mileageTotal = ( floatval($data->rows[0]->elements[0]->distance->text) * $entertainerMileagePrice );
        $distance = $data->rows[0]->elements[0]->distance->text;
        //$str = '<label><b>Distance: </b></label> <span>'.((int)$data->rows[0]->elements[0]->distance->value / 1000).' Km'.'</span> <br><br>';
        $str = '<label><b>Mileage charge: </b></label> <span>'.$mileageTotal.'£ </span> <br><br>';
        $str .= '<label><b>Distance: </b></label> <span>'.$distance.'</span> <br><br>';
        //$str .= '<label><b>Travel Time: </b></label> <span>'.$data->rows[0]->elements[0]->duration->text.'</span>';
        $str .= Html::hiddenInput('entertainer_mileage_total',$mileageTotal,['class'=>'mileage-total-class']);
        echo $str;
    }

    /**
     * entertainers enquiry detailed info
     */
    public function actionEntertainerEnquiryDetailedInfo($id) {
        $entertainerEnquiry = EntertainerEnquiries::findOne($id);
        $partyTypeData = PartyType::find()->all();
        $entertainerEnquiryNotifications = EntertainerEnquiryNotifications::find()->where(['enquiry_id'=>$id])->all();
        return $this->render('account/enquiry-detailed-info',['entertainerEnquiry' => $entertainerEnquiry,'partyTypeData'=>$partyTypeData,'entertainerEnquiryNotifications'=>$entertainerEnquiryNotifications]);
    }

    public function actionEnquiryChooseDate(){
        if(Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $comment = Yii::$app->request->post('comment');
            $date = Yii::$app->request->post('date');
            $startTime = Yii::$app->request->post('start_time');
            $endTime = Yii::$app->request->post('end_time');
            $flag = Yii::$app->request->post('flag');

            // dump($id);
            // dump($comment);
            // dump($date);
            // dump($startTime);
            // dump($endTime);
            // dump($flag);die;
            $entertainerEnquiry = EntertainerEnquiries::findOne($id);
            if($flag === 'entertainer_confirms') {
                //copy to tbl_entertainer_orders from tbl_entertainer_enquiries
                //insert into tbl_entertainer_notifications the current step
                if(!empty($date) && !empty($startTime) && !empty($endTime)) {
                    $entertainerEnquiryPrices = EntertainerEnquiryPrices::find()->where(['enquiry_id'=>$id])->all();
                    Yii::$app->db->createCommand()->insert('tbl_orders',[
                        'entertainer_id' => $entertainerEnquiry['entertainer_id'],
                        'customer_id' => $entertainerEnquiry['customer_id'],
                        'status' => 'Unacknowledged',
                        'price' => $entertainerEnquiry['price']
                    ])->execute();
                    $orderID = Yii::$app->db->getLastInsertID();
                    Yii::$app->db->createCommand()->insert('tbl_entertainer_orders',[
                        'entertainer_id' => $entertainerEnquiry['entertainer_id'],
                        'order_id' => $orderID,
                        'party_type_id' => $entertainerEnquiry['party_type_id'],
                        'event_date' => $date,
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'theme_service_id' => $entertainerEnquiry['theme_service_id'],
                        'entertainers_count' => $entertainerEnquiry['entertainers_count'],
                        'special_requests' => $entertainerEnquiry['special_requests'],
                        'host_child_age' => $entertainerEnquiry['host_child_age'],
                        'host_child_name' => $entertainerEnquiry['host_child_name'],
                        'host_child_gender' => $entertainerEnquiry['host_child_gender'],
                        'status' => 'Pending',
                        'info_status' => 'Unacknowledged',
                        'customer_id' => $entertainerEnquiry['customer_id'],
                        'enquiry_id' => $entertainerEnquiry['id']
                    ])->execute();

                    foreach($entertainerEnquiryPrices as $enquiryPrice) {
                        Yii::$app->db->createCommand()->insert('tbl_entertainer_order_prices',[
                            'customer_id' => $enquiryPrice['customer_id'],
                            'entertainer_id' => $enquiryPrice['entertainer_id'],
                            'order_id' => $orderID,
                            'entertainer_service_id' => $enquiryPrice['entertainer_service_id'],
                            'extra_guest_count' => $enquiryPrice['extra_guest_count'],
                            'service_type' => $enquiryPrice['service_type']
                        ])->execute();
                    }

                    $note = 'Entertainer chose the final date: '.$date.' '.$startTime.' - '.$endTime;
                    Yii::$app->db->createCommand()->insert('tbl_entertainer_enquiry_notifications',[
                        'customer_id' => $entertainerEnquiry['customer_id'],
                        'entertainer_id' => $entertainerEnquiry['entertainer_id'],
                        'enquiry_id' => $id,
                        'note' => $note,
                        'status' => 'active'
                    ])->execute();

                    $entertainerEnquiry->status = 'confirmed';
                    $entertainerEnquiry->order_id = $orderID;
                    $entertainerEnquiry->save();
                }
            }else{
                //another case when entertainers suggests another date 
                Yii::$app->db->createCommand()->insert('tbl_entertainer_enquiry_notifications',[
                    'customer_id' => $entertainerEnquiry['customer_id'],
                    'entertainer_id' => $entertainerEnquiry['entertainer_id'],
                    'enquiry_id' => $id,
                    'note' => $comment,
                    'status' => 'pending'
                ])->execute();
                $entertainerEnquiry->status = 'being_discussed';
                $entertainerEnquiry->save();
            }
        }
    }

    /**
     * sends message to admin, admin will review the message then edits the 
     */
    public function actionSendMessageToCustomer() {
        if(Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('enquiry_id');
            $note = Yii::$app->request->post('note');
            $entertainerEnquiry = EntertainerEnquiries::findOne($id);
            Yii::$app->db->createCommand()->insert('tbl_entertainer_enquiry_notifications',[
                'customer_id' => $entertainerEnquiry['customer_id'],
                'entertainer_id' => $entertainerEnquiry['entertainer_id'],
                'enquiry_id' => $id,
                'note' => $note,
                'creator_id' => (Yii::$app->user->identity && Yii::$app->user->identity->id) ? Yii::$app->user->identity->id : 0,
                'status' => 'pending'
            ])->execute();
        }
    }

    /**
     * entertainers enquiry detailed info
     */
    public function actionEntertainerOrderDetailedInfo($id) {
        $entertainerOrders = new EntertainerOrders();
        $entertainerOrderData = $entertainerOrders->getDataByOrder($id);
        $entertainerStaff = EntertainerStaff::find()->where(['entertainer_id'=>$entertainerOrderData['entertainer_id']])->asArray()->all();
        $entertainerOrderData['entertainers'] = $entertainerStaff;
        $entertainerOrdersStaffData = EntertainerOrdersStaff::find()->where(['entertainer_order_id'=>$entertainerOrderData['id']])->all();
        $entertainerOrdersStaff = array_map(function($item){return $item['entertainer_staff_id'];}, $entertainerOrdersStaffData);


        $busyScheduleObj = EntertainerBusySchedule::find()->select('busy_date')->where(['entertainer_id'=>Yii::$app->user->identity->id, 'busy_start_time'=>null, 'busy_end_time'=>null])->all();
        $busyDays = json_encode(array_map(function($item){
            return $item['busy_date'];
        }, $busyScheduleObj));

        return $this->render('account/order-detailed-info',['entertainerOrderData' => $entertainerOrderData,'busyDays'=>$busyDays,'entertainerOrdersStaff'=>$entertainerOrdersStaff]);
    }


    /**
     * updates entertainer order staff list
     * logic is not completed, finish
     */
    public function actionUpdateEntertainerOrderStaffList(){
        if(Yii::$app->request->isAjax) {
            $orderID = Yii::$app->request->post('order_id');
            
            $postedStaffList = Json::decode(Yii::$app->request->post('staff'));
            $existStaffList = array_map(function($item){return $item->entertainer_staff_id;},EntertainerOrdersStaff::find()->where(['entertainer_order_id'=>$orderID])->all());

            $diffPostedExistStaffList = array_diff($postedStaffList, $existStaffList);
            $diffExistPostedStaffList = array_diff($existStaffList, $postedStaffList);

            if(!empty($diffPostedExistStaffList)) {
                foreach($diffPostedExistStaffList as $staff) {
                    $model = new EntertainerOrdersStaff();
                    $model->entertainer_order_id = $orderID;
                    $model->entertainer_staff_id = $staff;
                    $model->creator_id = Yii::$app->user->identity->id;
                    $model->save();
                }
            }

            if(!empty($diffExistPostedStaffList)) {
                foreach($diffExistPostedStaffList as $staff){
                    $model = EntertainerOrdersStaff::find()->where(['entertainer_order_id'=>$orderID, 'entertainer_staff_id' => $staff])->one();
                    $model->delete();
                }
            }
            echo 1;
        }
    }

    public function actionSendNotificationToCustomer(){
        if(Yii::$app->request->isAjax) {
            $entertainerID = Yii::$app->request->post('entertainer_id');
            $customerID = Yii::$app->request->post('customer_id');
            $entertainerOrderID = Yii::$app->request->post('entertainer_order_id');
            $message = Yii::$app->request->post('message');

            $entertainerOrderNotification = new EntertainerOrderNotifications();
            $entertainerOrderNotification->entertainer_id = $entertainerID;
            $entertainerOrderNotification->customer_id = $entertainerID;
            $entertainerOrderNotification->entertainer_order_id = $entertainerOrderID;
            $entertainerOrderNotification->sent_by_entertainer = 1;
            $entertainerOrderNotification->message = $message;
            $entertainerOrderNotification->save();
            echo 1;
        }
    }

}
