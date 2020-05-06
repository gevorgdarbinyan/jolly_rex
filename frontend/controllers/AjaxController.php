<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use common\models\User;
use common\models\UserPhotos;
use common\models\Venue;
use common\models\food\FoodItems;
use common\models\product\ProductItems;
use common\models\OrderFoodItems;
use common\models\OrderProductItems;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;
use yii\helpers\Json;

class AjaxController extends Controller {

    public $enableCsrfValidation = false;

    public function beforeAction($action) {

        if (parent::beforeAction($action)) {

            Yii::$app->getResponse()->format = Response::FORMAT_JSON;
            return true;
        }
    }
    
    public function actionCheckLoginData() {
        if (Yii::$app->request->isAjax) {
            $login = Yii::$app->request->post('login');
            $password = md5(Yii::$app->request->post('password'));
            
            $userQuery = User::find()->where(['email' => $login, 'password' => $password])->all();
            
            if ($userQuery) {
                return ['success' => true];
            }
            
            return ['success' => false];
        }
    }

    public function actionLoadVenueList() {
        if (Yii::$app->request->isAjax) {
            
            $venueName = Yii::$app->request->post('venue_name');
            
            if ($venueName) {
                $venueDataQuery = "SELECT * FROM tbl_venue WHERE name LIKE '%$venueName%'";
                $venueData = Yii::$app->db->createCommand($venueDataQuery)->queryAll();
            } else {
                $venueData = Venue::find()->all();
            }
            
            $str = '';

            foreach ($venueData as $venue) {
                $str .= Html::beginTag('div', ['class' => 'col-xs-12 col-md-6']);
                $str .= Html::beginTag('div', ['class' => 'venue-info-main venue-wrap clearfix']);
                $str .= Html::beginTag('div', ['class' => 'row']);

                $str .= Html::beginTag('div', ['class' => 'col-md-5 col-sm-12 col-xs-12']);
                $str .= Html::beginTag('div', ['class' => 'venue-image']);
                $str .= Html::img('/images/venueLayer.jpg', ['class' => 'img-responsive']);
                $str .= Html::endTag('div');
                $str .= Html::endTag('div');

                $str .= Html::beginTag('div', ['class' => 'col-lg-12 col-md-12']);
                $str .= Html::beginTag('h5', ['class' => 'name']);
                $str .= $venue['name'];
                $str .= Html::endTag('h5');
                $str .= Html::beginTag('p', ['class' => 'price-container']);
                $str .= Html::beginTag('span');
                $str .= $venue['price'] . ' £ / hour';
                $str .= Html::endTag('span');
                $str .= Html::endTag('p');
                $str .= Html::beginTag('span', ['class' => 'tag1']);
                $str .= Html::endTag('span');
                $str .= Html::endTag('div');

                $str .= Html::beginTag('div', ['class' => 'col-md-12']);

                $userRating = $venue['rating'];
                for ($i = 0; $i < 5; $i++) {
                    if ($i < $userRating) {
                        $str .= '<span class="glyphicon glyphicon-star rating-stars-yellow"></span>';
                    } else {
                        $str .= '<span class="glyphicon glyphicon-star rating-stars-grey"></span>';
                    }
                }

                $str .= Html::endTag('div');
                
                $str .= Html::beginTag('div', ['class' => 'col-md-7 col-sm-12 col-xs-12']);

//                $str .= Html::beginTag('div', ['class' => 'description']);
//                $str .= Html::beginTag('p');
//                $str .= $venue['short_description'];
//                $str .= Html::endTag('p');
//                $str .= Html::endTag('div');

                $str .= Html::beginTag('div', ['class' => 'venue-info smart-form']);
                $str .= Html::beginTag('div', ['class' => 'row']);

                $str .= Html::beginTag('div', ['class' => 'form-group']);
                $str .= Html::button('Add', ['class' => 'btn btn-danger add_venue_to_event', 'rel' => $venue['id']]);
                $str .= Html::endTag('div');

                $str .= Html::endTag('div');
                $str .= Html::endTag('div');

                $str .= Html::endTag('div');

                $str .= Html::endTag('div');
                $str .= Html::endTag('div');
                $str .= Html::endTag('div');
            }

            return ['venue_data_list' => $str];
        }
    }
    
    public function actionAddVenueToOrder() 
    {
        if (Yii::$app->request->isAjax) {
            $orderID = Yii::$app->request->post('order_id');
            $venueID = Yii::$app->request->post('venue_id');
            
            if ($orderID && $venueID) {
                Yii::$app->db->createCommand()->update('tbl_orders', ['venue_id' => $venueID], 'id = ' . $orderID)->execute();
                
                $venueName = Venue::find()->select('name')->where(['id' => $venueID])->one();

                return ['success' => true, 'venueName' => $venueName['name']];
            }
        }
    }
    
    public function actionLoadFoodList() {
        if (Yii::$app->request->isAjax) {
            
            $foodName = Yii::$app->request->post('food_name');
            $orderIDValForFood = Yii::$app->request->post('order_id_val');
//            $selectedFoodItems = Yii::$app->request->post('selected_food_items');
            
            if ($foodName) {
                $foodDataQuery = "SELECT * FROM tbl_food_items WHERE name LIKE '%$foodName%'";
                $foodData = Yii::$app->db->createCommand($foodDataQuery)->queryAll();
            } else {
                $foodData = FoodItems::find()->all();
            }
            
            $str = '';

            $str .= Html::hiddenInput('hidden_food_items', '', ['class' => 'selected_food_items']);
            $str .= Html::hiddenInput('hidden_order_id', $orderIDValForFood, ['class' => 'order_id_val_for_food']);
            
            $foodItemsCount = 0;
            
            foreach ($foodData as $food) {
                $str .= Html::beginTag('div', ['class' => 'col-lg-5 col-md-5 col-sm-12 col-xs-12 food-item-list-block', 'food-item-id' => $food['id'], 'food-provider-id' => $food['food_id']]);
                $str .= Html::beginTag('div', ['class' => 'venue-info-main venue-wrap clearfix']);
                $str .= Html::beginTag('div', ['class' => 'row']);

                $str .= Html::beginTag('div', ['class' => 'col-md-5 col-sm-12 col-xs-12']);
                $str .= Html::beginTag('div', ['class' => 'venue-image']);
                $str .= Html::img('/images/foodLayer.jpg', ['class' => 'img-responsive']);
                $str .= Html::endTag('div');
                $str .= Html::endTag('div');

                $str .= Html::beginTag('div', ['class' => 'col-lg-12 col-md-12']);
                $str .= Html::beginTag('h5', ['class' => 'name']);
                $str .= $food['name'];
                $str .= Html::endTag('h5');
                $str .= Html::beginTag('p', ['class' => 'price-container']);
                $str .= Html::beginTag('span');
                $str .= $food['price'] . ' £';
                $str .= Html::endTag('span');
                $str .= Html::endTag('p');
                $str .= Html::beginTag('span', ['class' => 'tag1']);
                $str .= Html::endTag('span');
                $str .= Html::endTag('div');

                $str .= Html::beginTag('div', ['class' => 'col-md-12']);

//                $userRating = $food['rating'];
                $userRating = 3;
                for ($i = 0; $i < 5; $i++) {
                    if ($i < $userRating) {
                        $str .= '<span class="glyphicon glyphicon-star rating-stars-yellow"></span>';
                    } else {
                        $str .= '<span class="glyphicon glyphicon-star rating-stars-grey"></span>';
                    }
                }

                $str .= Html::endTag('div');
                
                $str .= Html::beginTag('div', ['class' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12']);

//                $str .= Html::beginTag('div', ['class' => 'description']);
//                $str .= Html::beginTag('p');
//                $str .= $venue['short_description'];
//                $str .= Html::endTag('p');
//                $str .= Html::endTag('div');

                $str .= Html::beginTag('div', ['class' => 'venue-info smart-form']);
                $str .= Html::beginTag('div');

                $str .= Html::beginTag('div');
//                $str .= Html::button('Add', ['class' => 'btn btn-danger add_venue_to_event', 'rel' => $food['id']]);
                
//                $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2']);
//                $str .= Html::button('-', ['class' => 'input-number-decrement']);
//                $str .= Html::endTag('div');
//                $str .= Html::beginTag('div', ['class' => 'col-lg-6 col-md-6']);
//                $str .= Html::textInput('count', 1, ['class' => 'input-number', 'style' => 'width: 142%;']);
//                $str .= Html::endTag('div');
//                $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2']);
//                $str .= Html::button('+', ['class' => 'input-number-increment']);
//                $str .= Html::endTag('div');
                

//                $str .= '<div class="input-group">
//                                  <span class="input-group-btn">
//                                      <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
//                                        <span class="glyphicon glyphicon-minus"></span>
//                                      </button>
//                                  </span>
//                                  <input type="text" name="quant[2]" class="form-control input-number" value="10" min="1" max="100">
//                                  <span class="input-group-btn">
//                                      <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
//                                          <span class="glyphicon glyphicon-plus"></span>
//                                      </button>
//                                  </span>
//                              </div>';
                
                $str .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="input-group">
                              <span class="input-group-addon input-number-decrement">-</span>
                              <input type="text" class="form-control bfh-number food-item-count" data-min="0" data-max="9999999" value="1">
                              <span class="input-group-addon input-number-increment">+</span>
                            </div>
                          </div>';

                
                $str .= Html::endTag('div');

                $str .= Html::endTag('div');
                $str .= Html::endTag('div');

                $str .= Html::endTag('div');

                $str .= Html::endTag('div');
                $str .= Html::endTag('div');
                $str .= Html::endTag('div');
                
                $foodItemsCount++;
                
                if ($foodItemsCount % 2 != 0) {
                    $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2 col-sm-12 col-xs-12']);
                    $str .= Html::endTag('div');
                }
                
            }
            
            $str .= Html::beginTag('div', ['class' => 'form-group']);
            $str .= Html::button('Select', ['class' => 'btn btn-danger select_food_items', 'disabled' => true]);
            $str .= Html::endTag('div');

            return ['food_data_list' => $str];
        }
    }
    

    public function actionLoadProductList() {
        if (Yii::$app->request->isAjax) {
            
            $productName = Yii::$app->request->post('product_name');
            $orderIDValForProduct = Yii::$app->request->post('order_id_val');
//            $selectedProductItems = Yii::$app->request->post('selected_product_items');
            
            if ($productName) {
                $productDataQuery = "SELECT * FROM tbl_product_items WHERE name LIKE '%$productName%'";
                $productData = Yii::$app->db->createCommand($productDataQuery)->queryAll();
            } else {
                $productData = ProductItems::find()->all();
            }
            
            $str = '';

            $str .= Html::hiddenInput('hidden_product_items', '', ['class' => 'selected_product_items']);
            $str .= Html::hiddenInput('hidden_order_id', $orderIDValForProduct, ['class' => 'order_id_val_for_product']);
            
            $productItemsCount = 0;
            
            foreach ($productData as $product) {
                $str .= Html::beginTag('div', ['class' => 'col-lg-5 col-md-5 col-sm-12 col-xs-12 product-item-list-block', 'product-item-id' => $product['id'], 'product-provider-id' => $product['product_id']]);
                $str .= Html::beginTag('div', ['class' => 'venue-info-main venue-wrap clearfix']);
                $str .= Html::beginTag('div', ['class' => 'row']);

                $str .= Html::beginTag('div', ['class' => 'col-md-5 col-sm-12 col-xs-12']);
                $str .= Html::beginTag('div', ['class' => 'venue-image']);
                $str .= Html::img('/images/productLayer.jpg', ['class' => 'img-responsive']);
                $str .= Html::endTag('div');
                $str .= Html::endTag('div');

                $str .= Html::beginTag('div', ['class' => 'col-lg-12 col-md-12']);
                $str .= Html::beginTag('h5', ['class' => 'name']);
                $str .= $product['name'];
                $str .= Html::endTag('h5');
                $str .= Html::beginTag('p', ['class' => 'price-container']);
                $str .= Html::beginTag('span');
                $str .= $product['price'] . ' £';
                $str .= Html::endTag('span');
                $str .= Html::endTag('p');
                $str .= Html::beginTag('span', ['class' => 'tag1']);
                $str .= Html::endTag('span');
                $str .= Html::endTag('div');

                $str .= Html::beginTag('div', ['class' => 'col-md-12']);

//                $userRating = $product['rating'];
                $userRating = 3;
                for ($i = 0; $i < 5; $i++) {
                    if ($i < $userRating) {
                        $str .= '<span class="glyphicon glyphicon-star rating-stars-yellow"></span>';
                    } else {
                        $str .= '<span class="glyphicon glyphicon-star rating-stars-grey"></span>';
                    }
                }

                $str .= Html::endTag('div');
                
                $str .= Html::beginTag('div', ['class' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12']);

//                $str .= Html::beginTag('div', ['class' => 'description']);
//                $str .= Html::beginTag('p');
//                $str .= $venue['short_description'];
//                $str .= Html::endTag('p');
//                $str .= Html::endTag('div');

                $str .= Html::beginTag('div', ['class' => 'venue-info smart-form']);
                $str .= Html::beginTag('div');

                $str .= Html::beginTag('div');
//                $str .= Html::button('Add', ['class' => 'btn btn-danger add_venue_to_event', 'rel' => $product['id']]);
                
//                $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2']);
//                $str .= Html::button('-', ['class' => 'input-number-decrement']);
//                $str .= Html::endTag('div');
//                $str .= Html::beginTag('div', ['class' => 'col-lg-6 col-md-6']);
//                $str .= Html::textInput('count', 1, ['class' => 'input-number', 'style' => 'width: 142%;']);
//                $str .= Html::endTag('div');
//                $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2']);
//                $str .= Html::button('+', ['class' => 'input-number-increment']);
//                $str .= Html::endTag('div');
                

//                $str .= '<div class="input-group">
//                                  <span class="input-group-btn">
//                                      <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
//                                        <span class="glyphicon glyphicon-minus"></span>
//                                      </button>
//                                  </span>
//                                  <input type="text" name="quant[2]" class="form-control input-number" value="10" min="1" max="100">
//                                  <span class="input-group-btn">
//                                      <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
//                                          <span class="glyphicon glyphicon-plus"></span>
//                                      </button>
//                                  </span>
//                              </div>';
                
                $str .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="input-group">
                              <span class="input-group-addon input-number-decrement">-</span>
                              <input type="text" class="form-control bfh-number product-item-count" data-min="0" data-max="9999999" value="1">
                              <span class="input-group-addon input-number-increment">+</span>
                            </div>
                          </div>';

                
                $str .= Html::endTag('div');

                $str .= Html::endTag('div');
                $str .= Html::endTag('div');

                $str .= Html::endTag('div');

                $str .= Html::endTag('div');
                $str .= Html::endTag('div');
                $str .= Html::endTag('div');
                
                $productItemsCount++;
                
                if ($productItemsCount % 2 != 0) {
                    $str .= Html::beginTag('div', ['class' => 'col-lg-2 col-md-2 col-sm-12 col-xs-12']);
                    $str .= Html::endTag('div');
                }
                
            }
            
            $str .= Html::beginTag('div', ['class' => 'form-group']);
            $str .= Html::button('Select', ['class' => 'btn btn-danger select_product_items', 'disabled' => true]);
            $str .= Html::endTag('div');

            return ['product_data_list' => $str];
        }
    }
    

    /**
     * loads more data at home page
     */
    public function actionLoadMoreData() {
        if (Yii::$app->request->isAjax) {
            
            $offset = Yii::$app->request->post('offset');

            $lastDivClass = Yii::$app->request->post('last_div_class');
            
            $homepageEntertainerDataQuery = "
                SELECT
                    tbl_entertainer.id AS id,
                    tbl_entertainer.name AS name,
                    tbl_entertainer.short_description AS short_description,
                    tbl_entertainer.description AS description,
                    tbl_entertainer.support_instant_booking,
                    tbl_entertainer.rating AS rating,
                    tbl_entertainer_photos.photo AS photo
                FROM tbl_entertainer
                LEFT JOIN tbl_entertainer_photos ON tbl_entertainer.id = tbl_entertainer_photos.entertainer_id
                LIMIT 2 OFFSET $offset
            ";
            $homepageEntertainerData = Yii::$app->db->createCommand($homepageEntertainerDataQuery)->queryAll();
            $dataProvider = new ArrayDataProvider([
                'allModels' => $homepageEntertainerData,
            ]);

            $str = '';
            foreach ($homepageEntertainerData as $data) {
                $str .= $this->renderAjax('/site/_list_item_homepage', ['model' => $data, 'last_div_class' => $lastDivClass]);
            }
            return ['success' => true, 'loadedData' => $str];
        }
    }
    
    public function actionEntertainerOrderAccept() {
        if (Yii::$app->request->isAjax) {
            $orderID = Yii::$app->request->post('order_id');
            $setStatusApproved = Yii::$app->db->createCommand()
                    ->update('tbl_orders', ['status' => 'Approved'], 'id = ' . $orderID)
                    ->execute();
            
            if ($setStatusApproved) {
                return ['success' => true];
            } else {
                return ['success' => false];
            }
        }
    }
    
    public function actionEntertainerOrderDecline() {
        if (Yii::$app->request->isAjax) {
            $orderID = Yii::$app->request->post('order_id');
            $setStatusCanceled = Yii::$app->db->createCommand()->update('tbl_orders', ['status' => 'canceled'], 'id = ' . $orderID)
                    ->execute();
            
            if ($setStatusCanceled) {
                return ['success' => true];
            } else {
                return ['success' => false];
            }
        }
    }
    
    public function actionGetSelectedFoodItems() {
        if (Yii::$app->request->isAjax) {
            $selectedFoodItemsJson = Yii::$app->request->post('selected_food_items');
            
            $selectedFoodItems = Json::decode($selectedFoodItemsJson, true);
            
            foreach ($selectedFoodItems as $foodItem) {
                $orderFoodItemsModel = new OrderFoodItems();
                
                $orderFoodItemsModel->order_id = $foodItem['order_id'];
                $orderFoodItemsModel->food_id = $foodItem['food_provider_id'];
                $orderFoodItemsModel->food_item_id = $foodItem['food_item_id'];
                $orderFoodItemsModel->count = $foodItem['food_item_count'];

                $orderFoodItemsModel->save();
                
            }
            return true;
        }
    }
    
    public function actionGetSelectedProductItems() {
        if (Yii::$app->request->isAjax) {
            $selectedProductItemsJson = Yii::$app->request->post('selected_product_items');
            
            $selectedProductItems = Json::decode($selectedProductItemsJson, true);
            
            foreach ($selectedProductItems as $productItem) {
                $orderProductItemsModel = new OrderProductItems();
                
                $orderProductItemsModel->order_id = $productItem['order_id'];
                $orderProductItemsModel->product_id = $productItem['product_provider_id'];
                $orderProductItemsModel->product_item_id = $productItem['product_item_id'];
                $orderProductItemsModel->count = $productItem['product_item_count'];

                $orderProductItemsModel->save();
            }
            return true;
        }
    }

    /**
     * gets weeks by given month
     */
    public function actionGetWeeksByMonth() {
        if(Yii::$app->request->isAjax) {
            $year = date('Y');
            $month = Yii::$app->request->post('month');
            $weeks = Yii::$app->Helper->weeksInMonth($month, $year);
            $options = '<option>Week</option>';
            foreach($weeks as $weekNum => $weekDates){
                $count = count($weekDates);
                $monthObject = new \DateTime($weekDates[0]);
                $monthWordShort = $monthObject->format('M');
                $firstDate = new \DateTime($weekDates[0]);
                $firstDayDate = $firstDate->format('d');
                $lastDate = new \DateTime($weekDates[$count - 1]);
                $lastDayDate = $lastDate->format('d');
                $dateString = ($firstDayDate == $lastDayDate) ? ($monthWordShort.' '.$firstDayDate) : ($monthWordShort.' '.$firstDayDate .' - '.$monthWordShort.' '.$lastDayDate);
                $options .= '<option value="'.$weekNum.'">'.$weekNum.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$dateString.'</option>';
            }
            return $options;
        }
    }

    public function actionGetDaysByWeek(){
        if(Yii::$app->request->isAjax) {
            $year = date('Y');
            $month = Yii::$app->request->post('month');
            $week = Yii::$app->request->post('week');
            $weeks = Yii::$app->Helper->weeksInMonth($month, $year);
            $weekDays = $weeks[$week];
            $options = '<option>Day</option>';
            foreach($weekDays as $weekDay){
                $date = new \DateTime($weekDay);
                $day = $date->format('l, F d, Y');
                $options .= '<option value="'.$weekDay.'">'.$day.'</option>';
            }
            return $options;
        }
    }

}
