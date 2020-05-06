<?php

namespace frontend\controllers;

use Yii;
use common\models\PartyType;
use common\models\Orders;
use common\models\OrdersSearch;
use common\models\entertainer\EntertainerOrders;
use common\models\venue\VenueOrders;
use common\models\entertainer\EntertainerOrderPrices;
use common\models\OrderFoodItems;
use common\models\OrderProductItems;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Html;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCustomerEntertainerOrder(){
        $entertainerID = Yii::$app->request->get('entertainer_id');
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('customer-entertainer-order', [
            'model' => $model,
            'entertainerID' => $entertainerID
        ]);
    }

    /**
     * customer orders entertainers functionality
     */
    public function actionToDoCustomerEntertainerOrder() {
        $orderData = Yii::$app->request->post('form_data');
        //echo "<pre>";print_r($orderData);die;
        //array_shift($orderData);
        $title = $orderData[0]['value'];
        $customerID = $orderData[1]['value'];
        $entertainerID = $orderData[2]['value'];
        $numberOfEntertainers = $orderData[3]['value'];
        $startDate = $orderData[4]['value'];
        $endDate = $orderData[5]['value'];
        $specialRequest = $orderData[6]['value'];
        $status = $orderData[7]['value'];

        $orders = new Orders();
        
        $orders->title = $title;
        $orders->customer_id = $customerID;
        $orders->entertainer_id = $entertainerID;
        $orders->event_date = $startDate;
        $orders->start_time = $startDate;
        $orders->end_time = $endDate;
        $orders->special_request = $specialRequest;
        $orders->status = $status;
        // @TOFIX valdiation in modal
        /*if(empty($orders->title)){
            $orders->addError('title','Title is mandatory');
            return $this->renderAjax('customer-entertainer-order', [
                'model' => $orders,
                'entertainerID' => $entertainerID
            ]);
        }*/
        //var_dump(Yii::getAlias('@root'));die;
        if($orders->save()) {
            // \Yii::$app->mail->compose()
            // ->setFrom('jolly rex')
            // ->setTo('gdarbinyan19@gmail.com')
            // ->setSubject('Email sent from Yii2-Swiftmailer')
            // ->send();
            echo 1;
        }
    }

    public function actionBook($data){
        $data = $_POST;
        $entertainerID = $data['entertainer_id'];
        $partyTypeID = $data['party_type_id'];
        $eventDate = $data['event_date'];
        $startTime = $data['start_time'];
        $endTime = $data['end_time'];
        $totalPrice = $data['total_price'];
        $specialRequest = $data['special_request'];
        $priceSetUps = Json::decode($_POST['price_set_ups']);
        $hostChildAge = $data['host_child_age'];
        $hostChildGender = $data['host_child_gender'];
        $telephoneNumber = $data['telephone_number'];
        $hostChildAge = $data['host_child_age'];
        $venueAddress = $data['venue_address'];
        $priceType = $data['price_type'];
        $entertainersCount = $data['entertainers_count'];
        if($priceType == 'package') {
            $entertainerPackageID = $data['package_id'];
        }

        $orders = new Orders();
        $orders->entertainer_id = $entertainerID;
        $orders->customer_id = Yii::$app->user->identity->id;
        $orders->party_type_id = $partyTypeID;
        $orders->event_date = $eventDate;
        $orders->start_time = $startTime;
        $orders->end_time = $endTime;
        $orders->entertainers_count = $entertainersCount;
        $orders->special_request = $specialRequest;
        $orders->price = $totalPrice;
        $orders->host_child_age = $hostChildAge;
        $orders->host_child_gender = $hostChildGender;
        $orders->telephone_number = $telephoneNumber;
        $orders->venue_address = $venueAddress;
        $orders->price_type = $priceType;
        $orders->status = 'Pending';
        if($priceType == 'package') {
            $orders->entertainer_package_id = $entertainerPackageID;
        }
        $result = '';
        if($orders->save()){
            $orderID = $orders->id;
            foreach($priceSetUps as $priceSetupID) {
                $orderSetup = new EntertainerOrderPrices();
                $orderSetup->entertainer_id = $entertainerID;
                $orderSetup->customer_id = Yii::$app->user->identity->id;
                $orderSetup->order_id = $orderID;
                if($priceType == 'service') {
                    $orderSetup->entertainer_service_id = $priceSetupID;
                }
                $orderSetup->save();
            }
            $result = $orderID;
        }
        echo $result;
    }

    public function actionBasket_() {
        $customerID = Yii::$app->user->identity->id;
        $orders = Orders::find()->where(['customer_id'=>$customerID])->all();
        
        $foodItemOrders = OrderFoodItems::find()
                ->select([
                    'tbl_orders.id AS order_id',
                    'tbl_orders.customer_id AS customer_id',
                    'tbl_order_food_items.food_id AS food_provider_id',
                    'tbl_order_food_items.food_item_id AS food_item_id',
                    'tbl_order_food_items.count AS count',
                    'tbl_food_items.name AS food_item_name'
                ])
                ->leftJoin('tbl_orders', 'tbl_orders.id = tbl_order_food_items.order_id')
                ->leftJoin('tbl_food_items', 'tbl_food_items.id = tbl_order_food_items.food_item_id')
                ->where(['tbl_orders.customer_id' => $customerID])
                ->asArray()
                ->all();
        
        $productItemOrders = OrderProductItems::find()
                ->select([
                    'tbl_orders.id AS order_id',
                    'tbl_orders.customer_id AS customer_id',
                    'tbl_order_product_items.product_id AS product_provider_id',
                    'tbl_order_product_items.product_item_id AS product_item_id',
                    'tbl_order_product_items.count AS count',
                    'tbl_product_items.name AS product_item_name'
                ])
                ->leftJoin('tbl_orders', 'tbl_orders.id = tbl_order_product_items.order_id')
                ->leftJoin('tbl_product_items', 'tbl_product_items.id = tbl_order_product_items.product_item_id')
                ->where(['tbl_orders.customer_id' => $customerID])
                ->asArray()
                ->all();
        
//        \yii\helpers\VarDumper::dump($foodItemOrders, 10, true);die;
//        \yii\helpers\VarDumper::dump($productItemOrders, 10, true);die;
        
        return $this->render('basket', [
            'orders'=>$orders,
            'foodItemOrders' => $foodItemOrders,
            'productItemOrders' => $productItemOrders,
        ]);
    }
    public function actionBasket_2018_11_11() {
        $customerID = Yii::$app->user->identity->id;
        if(isset($_GET['oID'])){
            $orderID = $_GET['oID'];
            // $orders = Orders::findOne($orderID);
            $orders = Orders::find()->where(['id'=>$orderID])->all();
        }else{
            $orders = Orders::find()->where(['customer_id'=>$customerID])->all();
        }

        $foodItemOrders = OrderFoodItems::find()
                ->select([
                    'tbl_orders.id AS order_id',
                    'tbl_orders.customer_id AS customer_id',
                    'tbl_order_food_items.food_id AS food_provider_id',
                    'tbl_order_food_items.food_item_id AS food_item_id',
                    'tbl_order_food_items.count AS count',
                    'tbl_food_items.name AS food_item_name'
                ])
                ->leftJoin('tbl_orders', 'tbl_orders.id = tbl_order_food_items.order_id')
                ->leftJoin('tbl_food_items', 'tbl_food_items.id = tbl_order_food_items.food_item_id')
                ->where(['tbl_orders.customer_id' => $customerID])
                ->asArray()
                ->all();
        
        $productItemOrders = OrderProductItems::find()
                ->select([
                    'tbl_orders.id AS order_id',
                    'tbl_orders.customer_id AS customer_id',
                    'tbl_order_product_items.product_id AS product_provider_id',
                    'tbl_order_product_items.product_item_id AS product_item_id',
                    'tbl_order_product_items.count AS count',
                    'tbl_product_items.name AS product_item_name'
                ])
                ->leftJoin('tbl_orders', 'tbl_orders.id = tbl_order_product_items.order_id')
                ->leftJoin('tbl_product_items', 'tbl_product_items.id = tbl_order_product_items.product_item_id')
                ->where(['tbl_orders.customer_id' => $customerID])
                ->asArray()
                ->all();
        
//        \yii\helpers\VarDumper::dump($foodItemOrders, 10, true);die;
//        \yii\helpers\VarDumper::dump($productItemOrders, 10, true);die;
        
        return $this->render('basket', [
            'orders'=>$orders,
            'foodItemOrders' => $foodItemOrders,
            'productItemOrders' => $productItemOrders
        ]);
    }

    public function actionBasket() {
        if (Yii::$app->user->identity) {
            $customerID = Yii::$app->user->identity->id;
            $order = Orders::find()->where(['customer_id'=>$customerID,'status'=>'Unacknowledged'])->limit(1)->one();
            //\yii\helpers\VarDumper::dump($order, 10, true);die;
            return $this->render('basket', ['order'=>$order]);
        }
    }

    public function actionAmendOrder() {
        $id = Yii::$app->request->post('order_id');
        $model = $this->findModel($id);

        return $this->renderAjax('amend-order', [
            'model' => $model
        ]);
    }

    public function actionSaveOrder()
    {
        if(Yii::$app->request->isAjax){
            $formData = $_POST['form_data'];
            $orderData = [];

            foreach ($formData as $info) {
                $name = $info['name'];
                $value = $info['value'];
                if (preg_match('/^Orders/', $name)) {
                    $pureName = $this->getPureName($name);
                    $orderData['Orders'][$pureName] = $value;
                }
            }
            $orders = $orderData['Orders'];
            $orderID = $orders['id'];
            
            $model = $this->findModel($orderID);
            

            $entertainerID = $model->entertainer_id;
            $customerID = $model->customer_id;
            if($model->price_type == 'service') {
                $priceSetups = (array)json_decode($orders['price_setups']);
                $entertainerOrderServiceData = EntertainerOrderPrices::find()->select('entertainer_service_id')->where(['entertainer_id'=>$entertainerID, 'customer_id'=>$customerID,'order_id'=>$orderID])->asArray()->all();
                $entertainerOrderServiceIDs = array_map(function($item){
                    return $item['entertainer_service_id'];
                },$entertainerOrderServiceData);
                //out($priceSetups);
                //out($entertainerOrderServiceIDs, true);
                $priceSetupsDiff = array_diff($priceSetups, $entertainerOrderServiceIDs);
                $servicesDiff = array_diff($entertainerOrderServiceIDs, $priceSetups);

                //out($priceSetupsDiff);
                //out($servicesDiff, true);

                if(!empty($priceSetupsDiff)) {
                    //@TODO insert into table
                    foreach($priceSetupsDiff as $priceSetupID) {
                        Yii::$app->db->createCommand()->insert('tbl_entertainer_order_prices',[
                            'entertainer_id'=>$entertainerID,
                            'customer_id'=>$customerID,
                            'order_id'=>$orderID,
                            'entertainer_service_id' => $priceSetupID
                        ])->execute();
                    }
                }
                if(!empty($servicesDiff)) {
                    //@TODO delete from table
                    foreach($priceSetupsDiff as $priceSetupID) {
                        Yii::$app->db->createCommand()->delete('tbl_entertainer_order_prices',
                            'entertainer_id= '.$entertainerID.' AND customer_id='.$customerID.' AND order_id='.$orderID.' AND entertainer_service_id='.$priceSetupID.''
                        )->execute();
                    }
                }
            }elseif($model->price_type === 'package'){
                $model->entertainer_package_id = $orders['entertainer_package_id'];
            }
            
            $model->customer_id = $customerID;
            $model->entertainer_id = $entertainerID;
            if(!empty($orders['venue_id'])) {
                $model->venue_id = $orders['venue_id'];
            }
            $model->event_date = $orders['event_date'];
            $model->start_time = $orders['start_time'];
            $model->end_time = $orders['end_time'];
            $model->price = $orders['price'];
            $model->special_request = $orders['special_request'];
            $model->host_child_age = $orders['host_child_age'];
            $model->host_child_gender = $orders['host_child_gender'];
            $model->host_child_name = $orders['host_child_name'];
            $model->telephone_number = $orders['telephone_number'];
            $model->venue_address = $orders['venue_address'];
            $model->save();
            echo 1;
        }
    }

    private function getPureName($name){
        $splittedWithLeftBracketString = explode('[',$name);
        $splittedWithRightBracketString = explode(']', $splittedWithLeftBracketString[1]);
        return $splittedWithRightBracketString[0];
    }

    public function actionCheckout($oID) {
        return $this->render('checkout',['orderID'=>$oID]);
    }

    /**
     * gets active order
     */
    public function actionGetPendingOrders() {
        if (Yii::$app->request->isAjax && Yii::$app->user->identity) {
            $customerID = Yii::$app->user->identity->id;
            $partyTypes = PartyType::find()->asArray()->all();
            $orderData = Orders::find()->where(['customer_id'=>$customerID,'status'=>'Unacknowledged'])->asArray()->all();
            $orders = [];
            foreach($orderData as $order) {
                $orders[$order['id']] = $order; 
            }
            $entertainerOrdersData = EntertainerOrders::find()->where(['customer_id'=>$customerID])->asArray()->all();
            $entertainerOrders = [];
            foreach($entertainerOrdersData as $entertainerOrder) {
                $entertainerOrders[$entertainerOrder['order_id']] = $entertainerOrder;
            }
            $venueOrdersData = VenueOrders::find()->where(['customer_id'=>$customerID])->asArray()->all();
            $venueOrders = [];
            foreach($venueOrdersData as $venueOrder){
                $venueOrders[$venueOrder['order_id']] = $venueOrder;
            }
            return $this->renderAjax('customer-orders', ['orders'=>$orders,'entertainerOrders'=>$entertainerOrders,'venueOrders'=>$venueOrders,'partyTypes'=>$partyTypes]);
        }
    }

    /**
     * gets historical orders
     */
    public function actionGetHistoricalOrders() {
        if (Yii::$app->request->isAjax && Yii::$app->user->identity) {
            $customerID = Yii::$app->user->identity->id;
            $orders = Orders::find()->where(['customer_id'=>$customerID])->all();
            echo $this->renderAjax('historical-orders', ['orders'=>$orders]);
        }
    }

    /**
     * cancels entertainer from order
     */
    public function actionCancelEntertainer(){
        if(Yii::$app->request->isAjax) {
            $orderID = Yii::$app->request->post('order_id');
            $entertainerID = Yii::$app->request->post('entertainer_id');
            $orderModel = $this->findModel($orderID);
            $orderModel->entertainer_id = 0;
            $orderModel->save();
            echo 1;
        }
    }

    public function actionCompletePayment() {
        if(Yii::$app->request->isAjax){
            $orderID = Yii::$app->request->post('order_id');
            //@TODO write payment staff
            $order = Orders::findOne($orderID);
            $order->status = 'Unacknowledged';
            $order->save();
            echo 1;
        }
    }

    public function actionConfirmation() {
        return $this->render('confirmation');
    }

    public function actionHomepage() {
        return $this->render('homepage');
    }
}
