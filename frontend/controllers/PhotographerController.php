<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use common\models\Photographer;
use common\models\PhotographerSearch;
use common\models\UserPhotos;
use common\models\Reviews;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\Orders;
use common\models\UserTypes;
use common\models\entertainer\EntertainerPartyThemes;
use yii2fullcalendar\models\Event;
use yii\helpers\ArrayHelper;
use common\models\entertainer\EntertainerServices;
use common\models\entertainer\EntertainerPackages;
use common\models\entertainer\EntertainerBusySchedule;
use common\models\PartyType;
use kartik\time\TimePicker;
use yii\helpers\Html;
use yii\helpers\Json;
/**
 * Site controller
 */
class PhotographerController extends Controller {

    const SUPPLIER_TYPE = 7;
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
        $searchModel = new PhotographerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel
        ]);
    }

    public function actionPage($id) {
        $userID = (Yii::$app->user->identity) ? Yii::$app->user->identity->id : 0;
        $userData = Photographer::find()
                ->select([
                    'tbl_entertainer.*',
                    'tbl_entertainer_photos.photo'
                ])
                ->leftJoin('tbl_entertainer_photos', 'tbl_entertainer_photos.entertainer_id = tbl_entertainer.id')
                ->where(['tbl_entertainer.id' => $id])
                ->asArray()
                ->one();
        
        $entertainerStaff = Entertainer::getEntertainerStaff($id);
        $userPartyThemesData = EntertainerPartyThemes::find()
                ->select([
                    'tbl_party_theme.id',
                    'tbl_entertainer_party_themes.entertainer_id',
                    'tbl_entertainer_party_themes.party_theme_id',
                    'tbl_party_theme.name'
                ])
                ->leftJoin('tbl_party_theme', 'tbl_party_theme.id = tbl_entertainer_party_themes.party_theme_id')
                ->asArray()
                ->all();
        $userPartyThemes = implode(', ', ArrayHelper::map($userPartyThemesData, 'id', 'name'));

        $ordersData = Orders::find()->all();
        $events = [];

        foreach ($ordersData as $order) {
            $event = new Event();
            $event->id = $order->id;
            //$event->title = $order->title;
            $event->start = $order->event_date.' '.$order->start_time;
            $event->end = $order->event_date.' '.$order->end_time;
            $event->backgroundColor = '#990000';
            $event->color = '#990000';
            $events[] = $event;
        }
        $supplierReviews = Reviews::find()->where(['supplier_id' => $id])->asArray()->all();
        $customerOwnReview = Reviews::find()->where(['customer_id'=>$userID,'supplier_id' => $id])->asArray()->one();
        $entertainerPriceData = EntertainerServices::find()->where(['entertainer_id'=>$id])->all();

        return  $this->render('page', [
                    'entertainerID'=>$id,
                    'entertainerStaff' => $entertainerStaff,
                    'userData' => $userData,
                    'userPartyThemes' => $userPartyThemes,
                    'events' => $events,
                    'supplierReviews' => $supplierReviews,
                    'customerOwnReview' => $customerOwnReview,
                    'entertainerPriceData' => $entertainerPriceData,
            ]);
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

    public function actionGetBusySchedule_() {
        $times = [
            '00:00'=>'00:00','00:15'=>'00:15','00:30'=>'00:30','00:45'=>'00:45',
            '01:00'=>'01:00','01:15'=>'01:15','01:30'=>'01:30','01:45'=>'01:45',
            '02:00'=>'02:00','02:15'=>'02:15','02:30'=>'02:30','02:45'=>'02:45',
            '03:00' => '03:00','03:15'=>'03:15','03:30'=>'03:30','03:45'=>'03:45',
            '04:00'=>'04:00','04:15'=>'04:15','04:30'=>'04:30','04:45'=>'04:45',
            '05:00'=>'05:00','05:15'=>'05:15','05:30'=>'05:30','05:45'=>'05:45',
            '06:00'=>'06:00','06:15'=>'06:15','06:30'=>'06:30','06:45'=>'06:45',
            '07:00'=>'07:00','07:15'=>'07:15','07:30'=>'07:30','07:45'=>'07:45',
            '08:00'=>'08:00','08:15'=>'08:15','08:30'=>'08:30','08:45'=>'08:45',
            '09:00'=>'09:00','09:15'=>'09:15','09:30'=>'09:30','09:45'=>'09:45',
            '10:00'=>'10:00','10:15'=>'10:15','10:30'=>'10:30','10:45'=>'10:45',
            '11:00'=>'11:00','11:15'=>'11:15','11:30'=>'11:30','11:45'=>'11:45',
            '12:00'=>'12:00','12:15'=>'12:15','12:30'=>'12:30','12:45'=>'12:45',
            '13:00'=>'13:00','13:15'=>'13:15','13:30'=>'13:30','13:45'=>'13:45',
            '14:00'=>'14:00','14:15'=>'14:15','14:30'=>'14:30','14:45'=>'14:45',
            '15:00'=>'15:00','15:15'=>'15:15','15:30'=>'15:30','15:45'=>'15:45',
            '16:00'=>'16:00','16:15'=>'16:15','16:30'=>'16:30','16:45'=>'16:45',
            '17:00'=>'17:00','17:15'=>'17:15','17:30'=>'17:30','17:45'=>'17:45',
            '18:00'=>'18:00','18:15'=>'18:15','18:30'=>'18:30','18:45'=>'18:45',
            '19:00'=>'19:00','19:15'=>'19:15','19:30'=>'19:30','19:45'=>'19:45',
            '20:00'=>'20:00','20:15'=>'20:15','20:30'=>'20:30','20:45'=>'20:45',
            '21:00'=>'21:00','21:15'=>'21:15','21:30'=>'21:30','21:45'=>'21:45',
            '22:00'=>'22:00','22:15'=>'22:15','22:30'=>'22:30','22:45'=>'22:45',
            '23:00'=>'23:00','23:15'=>'23:15','23:30'=>'23:30','23:45'=>'23:45'
            ];
        $entertainerID = Yii::$app->request->post('entertainer_id');
        $date = Yii::$app->request->post('date');
        $customerID = Yii::$app->user->identity->id;
        $busySchedule = EntertainerBusySchedule::find()->where(['entertainer_id'=>$entertainerID,'busy_date'=>$date])->asArray()->all();
        $orders = Orders::find()->where(['entertainer_id'=>$entertainerID,'customer_id'=>Yii::$app->user->identity->id,'event_date'=>$date])->asArray()->all();
        
        $busyStartTimes = EntertainerBusySchedule::find()->select('busy_start_time AS start_time')->where(['entertainer_id'=>$entertainerID,'busy_date'=>$date])->asArray()->all();
        $busyEndTimes = EntertainerBusySchedule::find()->select('busy_end_time AS end_time')->where(['entertainer_id'=>$entertainerID,'busy_date'=>$date])->asArray()->all();
        
        $orderStartTimes = Orders::find()->select('start_time')->where(['entertainer_id'=>$entertainerID,'customer_id'=>Yii::$app->user->identity->id,'event_date'=>$date])->asArray()->all();
        $orderEndTimes = Orders::find()->select('end_time')->where(['entertainer_id'=>$entertainerID,'customer_id'=>Yii::$app->user->identity->id,'event_date'=>$date])->asArray()->all();

        $startTimesData = array_merge($busyStartTimes, $orderStartTimes);
        $startTimes = array_map(function($item) {
            $time = explode(':', $item['start_time']);
            return $time[0].':'.$time[1];
        }, $startTimesData);

        $endTimesData = array_merge($busyEndTimes, $orderEndTimes);
        $endTimes = array_map(function($item) {
            $time = explode(':', $item['end_time']);
            return $time[0].':'.$time[1];
        }, $endTimesData);
        
        $str = Html::beginTag('div', ['class'=>'modal-body']);
            $str .= Html::beginTag('div',['class'=>'panel panel-warning']);
                $str .= Html::beginTag('div',['class'=>'panel-heading']);
                    $str .= 'Choose Your Time Now';
                $str .= Html::endTag('div');
                $str .= Html::beginTag('div',['class'=>'panel-body']);
                    $str .= Html::beginTag('table',['class'=>'table table-bordered']);
                        $str .= Html::beginTag('tr');
                            /*$str .= Html::beginTag('th');
                                $str .= 'Party Type';
                            $str .= Html::endTag('th');
                            $str .= Html::beginTag('th');
                                $str .= 'Party Theme';
                            $str .= Html::endTag('th');*/
                            // $str .= Html::beginTag('th');
                            //     $str .= 'Date';
                            // $str .= Html::endTag('th');
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
                        /*foreach($orders as $item) {
                            $orderID = $item['id'];
                            $partyType = PartyType::findOne($item['party_type_id']);
                            $priceSetups = Yii::$app->Helper->getOrderPriceSetups($orderID, $entertainerID, $customerID);
                            $countPriceSetups = count($priceSetups);
                            $str .= Html::beginTag('tr');
                                $str .= Html::beginTag('td');
                                    $str .= $partyType['name'];
                                $str .= Html::endTag('td');
                                $str .= Html::beginTag('td');
                                    $str .= Html::beginTag('table',['class'=>'table table-bordered']);
                                    foreach($priceSetups as $priceSetup) {
                                        $str .= Html::beginTag('tr');
                                            $str .= Html::beginTag('td');
                                                $str .= $priceSetup['name'];
                                            $str .= Html::endTag('td');
                                            $str .= Html::beginTag('td');
                                                $str .= $priceSetup['price'];
                                            $str .= Html::endTag('td');
                                        $str .= Html::endTag('tr');
                                    }
                                    $str .= Html::endTag('table');
                                $str .= Html::endTag('td');

                                // $str .= Html::beginTag('td');
                                //     $str .= $item['event_date'];
                                // $str .= Html::endTag('td');
                                
                                $str .= Html::beginTag('td');
                                    $str .= $item['start_time'];
                                $str .= Html::endTag('td');

                                $str .= Html::beginTag('td');
                                    $str .= $item['end_time'];
                                $str .= Html::endTag('td');

                                $str .= Html::beginTag('td');
                                    $str .= Yii::$app->Helper->getRemainingEntertainersCount($orderID, $entertainerID, $customerID);
                                $str .= Html::endTag('td');
                                
                            $str .= Html::endTag('tr');
                            // foreach($priceSetups as $priceSetup) {
                            //         $str .= Html::beginTag('tr');
                            //             $str .= Html::beginTag('td');
                            //                 $str .= $priceSetup['name'];
                            //             $str .= Html::endTag('td');
                            //             $str .= Html::beginTag('td');
                            //                 $str .= $priceSetup['price'];
                            //             $str .= Html::endTag('td');
                            //         $str .= Html::endTag('tr');
                            // }
                        }*/
                        $str .= Html::beginTag('tr');
                            $str .= Html::beginTag('td');
                                //$str .= Html::dropdownList('','',$startTimeList,['class'=>'start-time form-control']);
                                // $str .= Html::beginTag('select', ['class'=>'start-time form-control']);
                                //     foreach($times as $key => $value) {
                                //         /*if(!in_array($key, $startTimes)){
                                //             $options = [];
                                //         }else{
                                //             $options = ['disabled'=>'disabled'];
                                //         }*/
                                //         //$options = [];

                                //         //$str .= Html::beginTag('option',['value'=>$value]+$options);
                                //         $str .= Html::beginTag('option',['value'=>$value]);
                                //             $str .= $value;
                                //         $str .= Html::endTag('option');
                                //     }
                                // $str .= Html::endTag('select');
                                $str .= TimePicker::widget([
                                    'name' => 'start_time',
                                    'value' => date('H:i'),
                                    'pluginOptions' => [
                                        'showSeconds' => false,
                                        'showMeridian' => false,
                                    ],
                                    'options' => [
                                        'class' => 'start-time-class'
                                    ],
                                ]);
                            $str .= Html::endTag('td');
                            $str .= Html::beginTag('td');
                                //$str .= Html::dropdownList('','',$endTimeList,['class'=>'start-time form-control']);

                                // $str .= Html::beginTag('select', ['class'=>'end-time form-control']);
                                //     foreach($times as $key => $value) {
                                //         if(!in_array($key, $endTimes)){
                                //             $options = [];   
                                //         }else{
                                //             $options = ['disabled'=>'disabled'];
                                //         }
                                //         //$str .= Html::beginTag('option',['value'=>$value]+$options);
                                //         $str .= Html::beginTag('option',['value'=>$value]);
                                //             $str .= $value;
                                //         $str .= Html::endTag('option');
                                //     }
                                // $str .= Html::endTag('select');
                               $str .= TimePicker::widget([
                                    'name' => 'end_time',
                                    //'value' => date('H:i'),
                                    'value' => date('h:i', time()+3600),
                                    'pluginOptions' => [
                                        'showSeconds' => false,
                                        'showMeridian' => false,
                                    ],
                                    'options' => [
                                        'class' => 'end-time-class'
                                    ],
                                ]);
                            $str .= Html::endTag('td');
                            $str .= Html::beginTag('td');
                                $str .= Html::textInput('','' ,['class'=>'form-control entertainers-count-class']); 
                            $str .= Html::endTag('td');

                        $str .= Html::endTag('tr');
                    $str .= Html::endTag('table');
                    $str .= Html::beginTag('div', ['class'=>'cols-lg-6 cols-md-6 cols-sm-6 cols-xs-12']);
                    $str .= Html::beginTag('div', ['class'=>'form-group']);
                        $str .= Html::button('Choose',['class'=>'btn btn-primary choose-date-class']);
                    $str .= Html::endTag('div');
                $str .= Html::endTag('div');

                    // $str .= Html::beginTag('table',['class'=>'table table-bordered']);
                    //     $str .= Html::beginTag('tr');
                    //         $str .= Html::beginTag('th');
                    //             $str .= 'Party Type';
                    //         $str .= Html::endTag('th');
                    //         $str .= Html::beginTag('th',['colspan'=>2]);
                    //             $str .= 'Party Theme';
                    //         $str .= Html::endTag('th');
                    //         $str .= Html::beginTag('th');
                    //             $str .= 'Date';
                    //         $str .= Html::endTag('th');
                    //         $str .= Html::beginTag('th');
                    //             $str .= 'Start';
                    //         $str .= Html::endTag('th');
                    //         $str .= Html::beginTag('th');
                    //             $str .= 'End';
                    //         $str .= Html::endTag('th');
                    //         $str .= Html::beginTag('th');
                    //             $str .= 'How many entertainers are available?';
                    //         $str .= Html::endTag('th');
                    //     $str .= Html::endTag('tr');
                    //     $str .= Html::beginTag('tr');
                    //         $str .= Html::beginTag('th',['rowspan'=>2]);
                    //             $str .= 'Party Type';
                    //         $str .= Html::endTag('th');
                    //         $str .= Html::beginTag('th');
                    //             $str .= 'Party Theme';
                    //         $str .= Html::endTag('th');
                    //         $str .= Html::beginTag('th');
                    //             $str .= 'Party Theme11';
                    //         $str .= Html::endTag('th');
                    //         $str .= Html::beginTag('th',['rowspan'=>2]);
                    //             $str .= 'Date';
                    //         $str .= Html::endTag('th');
                    //         $str .= Html::beginTag('th',['rowspan'=>2]);
                    //             $str .= 'Start';
                    //         $str .= Html::endTag('th');
                    //         $str .= Html::beginTag('th',['rowspan'=>2]);
                    //             $str .= 'End';
                    //         $str .= Html::endTag('th');
                    //         $str .= Html::beginTag('th',['rowspan'=>2]);
                    //             $str .= 'How many entertainers are available?';
                    //         $str .= Html::endTag('th');
                    //     $str .= Html::endTag('tr');
                    //     $str .= Html::beginTag('tr');
                            
                    //         $str .= Html::beginTag('th');
                    //             $str .= 'Party Theme';
                    //         $str .= Html::endTag('th');
                    //         $str .= Html::beginTag('th');
                    //             $str .= 'Party Theme11';
                    //         $str .= Html::endTag('th');
                           
                    //     $str .= Html::endTag('tr');
                    // $str .= Html::endTag('table');
                $str .= Html::endTag('div');
            $str .= Html::endTag('div');

            

        /*$str .= Html::beginTag('div', ['class'=>'event-time-container']);
            $str .= Html::beginTag('div',['class'=>'row']);
                $str .= Html::beginTag('div', ['class'=>'cols-lg-6 cols-md-6 cols-sm-6 cols-xs-12']);
                    $str .= Html::beginTag('div', ['class'=>'form-group']);
                        $str .= Html::label('Start Time');
                        $str .= Html::dropdownList('','',$times,['class'=>'start-time form-control']);
                    $str .= Html::endTag('div');
                $str .= Html::endTag('div');

                $str .= Html::beginTag('div', ['class'=>'cols-lg-6 cols-md-6 cols-sm-6 cols-xs-12']);
                    $str .= Html::beginTag('div', ['class'=>'form-group']);
                        $str .= Html::label('End Time');
                        $str .= Html::dropdownList('','',$times,['class'=>'end-time form-control']);
                    $str .= Html::endTag('div');
                $str .= Html::endTag('div');

                $str .= Html::beginTag('div', ['class'=>'cols-lg-6 cols-md-6 cols-sm-6 cols-xs-12']);
                    $str .= Html::beginTag('div', ['class'=>'form-group']);
                        $str .= Html::button('Choose',['class'=>'btn btn-primary choose-date-class']);
                    $str .= Html::endTag('div');
                $str .= Html::endTag('div');

            $str .= Html::endTag('div');
        $str .= Html::endTag('div');*/


            $str .= Html::beginTag('div',['class'=>'panel panel-danger']);
                $str .= Html::beginTag('div',['class'=>'panel-heading']);
                    $str .= 'No Entertainers Available at This Time';
                $str .= Html::endTag('div');
                $str .= Html::beginTag('div',['class'=>'panel-body']);
                    $str .= Html::beginTag('table',['class'=>'table table-borderedless']);
                        /*$str .= Html::beginTag('tr');
                            // $str .= Html::beginTag('td');
                            //     $str .= 'Date';
                            // $str .= Html::endTag('td');
                            $str .= Html::beginTag('th');
                                $str .= 'Start';
                            $str .= Html::endTag('th');
                            $str .= Html::beginTag('th');
                                $str .= 'End';
                            $str .= Html::endTag('th');
                        $str .= Html::endTag('tr');*/
                        foreach($busySchedule as $item) {
                            $str .= Html::beginTag('tr',[]);
                                // $str .= Html::beginTag('td');
                                //     $str .= $item['busy_date'];
                                // $str .= Html::endTag('td');
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
                    $str .= Html::endTag('table');
                $str .= Html::endTag('div');
            $str .= Html::endTag('div');
        $str .= Html::endTag('div');
        ob_start();
            echo $str;
        return ob_get_clean();
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
            $model = new EntertainerBusySchedule();

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
            $model->save();
            ob_start();
                echo Json::encode(EntertainerBusySchedule::findOne($model->id));
            return ob_get_clean();
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
}
