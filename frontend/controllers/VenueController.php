<?php

namespace frontend\controllers;

use common\models\UserSearch;
use common\models\Venue;
use common\models\VenueSearch;
use common\models\venue\VenueOptions;
use common\models\venue\VenueOrders;
use common\models\UserTypes;
use yii\web\Controller;
use common\models\User;
use common\models\Orders;
use Yii;

class VenueController extends Controller {

    public function actionIndex() {

        $orderData = [];
        if(Yii::$app->user->identity){
            $customerID = Yii::$app->user->identity->id;
            $orderData = Orders::find()->where(['customer_id'=>$customerID])->limit(1)->one();
        }

        /*$searchModel = new UserSearch();
        $dataProvider = $searchModel->searchVenue(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy('rating DESC')->andWhere(['user_type_id' => 3]);

        $userTypeData = UserTypes::find()
                ->where(['<>', 'name', 'Sys Admin'])
                ->all();
        

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'userTypeData' => $userTypeData
        ]);*/

        $searchModel = new VenueSearch();
        $searchUserModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy('rating DESC');

        $userTypeData = UserTypes::find()
                ->where(['<>', 'name', 'Sys Admin'])
                ->all();

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'searchUserModel' => $searchUserModel,
                    'userTypeData' => $userTypeData,
                    'orderData'=>$orderData
        ]);
    }
    
    public function actionPage($id) {
        $orderData = [];
        if(Yii::$app->user->identity){
            $customerID = Yii::$app->user->identity->id;
            $orderData = Orders::find()->where(['customer_id'=>$customerID])->limit(1)->one();
            $oID = $orderData->id;
        }
        
        $venueData = Venue::findOne($id);
        $venueOptionsData = VenueOptions::find()->where(['venue_id'=>$id])->all();
        $venueOrders = VenueOrders::find()->where(['venue_id'=>$id,'order_id'=>$oID])->one();
        
        return $this->render('page', [
            'venueData' => $venueData,
            'venueOptionsData' => $venueOptionsData,
            'venueID' => $id,
            'orderData' => $orderData,
            'venueOrders' => $venueOrders
        ]);
    }

    public function actionGetPrice(){
        if(Yii::$app->request->isAjax) {
            $venueID = Yii::$app->request->post('venue_id');
            $room = Yii::$app->request->post('room');
            $hour = Yii::$app->request->post('hour');

            $venueOptions = VenueOptions::find()->where(['venue_id'=>$venueID,'name'=>$room])->one();
            echo $hour * $venueOptions['price'];
        }
    }

    public function actionReserve() {
        if(Yii::$app->request->isAjax) {
            $venueID = Yii::$app->request->post('venue_id');
            $orderID = Yii::$app->request->post('order_id');
            $eventDate = Yii::$app->request->post('event_date');
            $startTime = Yii::$app->request->post('start_time');
            $endTime = Yii::$app->request->post('end_time');
            $price = Yii::$app->request->post('price');
            $supportInstantBooking = Yii::$app->request->post('support_instant_booking');

            if($supportInstantBooking) {
                $orders = Orders::findOne($orderID);
                $orderPrice = $orders->price;
                $orders->venue_id = $venueID;

                $orders->price += $orderPrice;
                
                if($orders->save()){
                    $venueOrders = new VenueOrders();
                    $venueOrders->order_id = $orderID;
                    $venueOrders->venue_id = $venueID;
                    $venueOrders->price = $price;
                    $venueOrders->event_date = $eventDate;
                    $venueOrders->start_time = $startTime;
                    $venueOrders->end_time = $endTime;
                }

                if($venueOrders->save(false)){
                    echo $this->renderAjax('orders/venue-block',['venueOrders'=>$venueOrders,'orderData'=>$orders]);
                }
            }else{
                $orders = new Orders();
                $orders->customer_id = Yii::$app->user->identity->id;
                $orders->entertainer_id = 0;
                $orders->venue_id = $venueID;
                $orders->price = $price;
                $orders->status = 'non_answered';
                $orders->creator_id = Yii::$app->user->identity->id;
                $orders->order_type = 'enquiry';
                //out($orders);
                if($orders->save()){
                    $orderID = Yii::$app->db->getLastInsertID();
                    $venueOrders = new VenueOrders();
                    $venueOrders->order_id = $orderID;
                    $venueOrders->venue_id = $venueID;
                    $venueOrders->price = $price;
                    $venueOrders->event_date = $eventDate;
                    $venueOrders->start_time = $startTime;
                    $venueOrders->end_time = $endTime;
                    if($venueOrders->save(false)){
                        echo "enquiry";
                        //@TODO
                        // send emails to customer, entertainer, admin
                    }
                }
            }
        }
    }

    public function actionActiveOrderLine() {
        $order = [];
        if(Yii::$app->user->identity){
            $customerID = Yii::$app->user->identity->id;
            $order = Orders::find()->where(['customer_id'=>$customerID])->limit(1)->one();
        }
        return $this->render('/orders/active-order-line',['order'=>$order]);
    }

    /**
     * enquiry confirmation page
     */
    public function actionEnquiryConfirmation(){
        return $this->render('enquiry-confirmation');
    }

}
