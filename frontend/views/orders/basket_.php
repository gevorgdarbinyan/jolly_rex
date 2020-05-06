<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Basket';

$this->registerJsFile('@web/js/orders/basket.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/orders/venue.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/orders/food.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/orders/product.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/css/orders/basket.css');
?>
<?php
//out($orders);
?>

<div class="container">
   <div class="panel-group">
    <?php foreach($orders as $order):?>
      <div class="panel panel-success">
        <div class="panel-heading">ORDER #<?=$order->id;?></div>
        <div class="panel-body">
            Entertainer: <?=($order->entertainer_id) ? $order->entertainer_relation->name: 'Choose Entertainer';?>
            

        </div>
      </div>
    <?php endforeach;?>
    </div>
</div>

<div class="container">
    <div class="basket-orders-index">
        <h1 class="text-align-center"><?= Html::encode($this->title); ?></h1>

        <div class="orders-block">
            <table class="table table-curved table-striped">
                <tbody>
                    <tr>
                        <th>Entertainer</th>
                        <th>Venue</th>
                        <th>Food</th>
                        <th>Product</th>
                        <th></th>
                    </tr>
                <?php $total = 0;?>
                <?php foreach($orders as $order): ?>
                    <tr order-id="<?= $order->id ?>">
                        <td><?=$order->entertainer_relation->name;?></td>
                        <td>
                            <span class="selected-venue-class"><?= ($order->venue_relation) ? $order->venue_relation->name : '';?></span>
                            <span class="glyphicon glyphicon-plus choose_venue_btn" style="width:10px;cursor:pointer;color:#337ab7;"></span>
                        </td>
                        <td>
                            <?php
                            //out($foodItemOrders); 
                            if ($foodItemOrders) {
                                $selectedFoodItemsStr = '';
                                foreach ($foodItemOrders as $foodItem) {
                                    if ($order->id == $foodItem['order_id']) {
                                        $selectedFoodItemsStr .= $foodItem['food_item_name'] . ', ';
                                    }
                                }
                                ?>
                                <span><?=rtrim($selectedFoodItemsStr, ', ');?></span>
                            <?php } ?>
                            <span class="glyphicon glyphicon-plus choose_food_btn" style="width:10px;cursor:pointer;color:#337ab7;"></span>
                        </td>
                        <td>
                            <?php if ($productItemOrders) {
                                $selectedProductItemsStr = '';
                                foreach ($productItemOrders as $productItem) {
                                    if ($order->id == $productItem['order_id']) {
                                        $selectedProductItemsStr .= $productItem['product_item_name'] . ', ';
                                    }
                                }
                                ?>
                                <span class="selected-products" style="cursor:pointer;"><?=rtrim($selectedProductItemsStr, ', ');?></span>
                            <?php } ?>
                            <span class="glyphicon glyphicon-plus choose_product_btn" style="width:10px;cursor:pointer;color:#337ab7;"></span>
                        </td>
                        <td>
                            <span class="glyphicon glyphicon-pencil amend-order" title="Amend" style="cursor:pointer;" rel="<?=$order->id;?>"></span> 
                            <span class="glyphicon glyphicon-remove" title="Cancel" style="cursor:pointer;" rel="<?=$order->id;?>"></span> 
                        </td>
                    </tr>
                    <?php $total += $order['price'];?>
                <?php endforeach;?>
                <tr>
                    <td colspan="5">
                        <strong>Total:</strong>
                        <span class="total-amount-class"><?=$total;?></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="pull-right">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-lg-6 col-md-6">
                                <?= Html::a('Checkout', ['orders/checkout'], ['class' => 'btn btn-primary']) ?>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <!-- <div id="order-amendment-container">
                
            </div> -->
            <div class="container" id="order-amendment-container">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Amend order
                        <span class="glyphicon glyphicon-remove pull-right close-amend-order-panel"></span>


                    </div>
                    <div class="panel-body" id="order-amendment-panel">


                    </div>
                </div>
            </div>
            <?php 
//            echo GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'options' => [
//            'class' => 'table table-bordered',
//         ],
//        'columns' => [
//            //['class' => 'yii\grid\SerialColumn'],
//
//            //'id',
//            
//            //'entertainer_id',
//            [
//                'attribute'=>'entertainer_id',
//                'format' => 'raw',
//                'value' => function($data) {
//                    $str = Html::a($data->entertainer_relation->name,['entertainers/page','id'=>$data->entertainer_relation->id]);
//                    $str .= ' <span class="glyphicon glyphicon-plus" style="font-size:10px"></span>';
//                    return $str;
//                }
//            ],
//            [
//                'attribute'=>'venue_id',
//                'format' => 'raw',
//                'value' => function($data) {
//                    if($data->venue_relation && $data->venue_relation->name) {
//                        $str = Html::a($data->venue_relation->name,['venue/page','id'=>$data->venue_relation->id]);
//                        $str .= ' <span class="glyphicon glyphicon-plus" style="font-size:10px"></span>';
//                        return $str;
//                    }
//                    return null;
//                }
//            ],
//            [
//                'attribute'=>'food_id',
//                'format' => 'raw',
//                'value' => function($data) {
//                    if($data->food_relation && $data->food_relation->name) {
//                        return Html::a($data->food_relation->name,['venue/page','id'=>$data->food_relation->id]);
//                    }
//                    return null;
//                }
//            ],
//            [
//                'attribute'=>'product_id',
//                'format' => 'raw',
//                'value' => function($data) {
//                    if($data->product_relation && $data->product_relation->name) {
//                        return Html::a($data->product_relation->name,['venue/page','id'=>$data->product_relation->id]);
//                    }
//                    return null;
//                }
//            ],
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'template' => '{update}{delete}',
//                'buttons' => [
//                    'update' => function($url, $model){
//                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['entertainer-photos/update', 'entertainer_id' => $model->entertainer_id,'id'=>$model->id],[]);
//                    }
//                ],
//            ],
//        ],
//    ]); 
                ?>

            <?php
//            echo 
//            ListView::widget([
//                'dataProvider' => $dataProvider,
//                'options' => [
//                    'tag' => 'div',
//                    'class' => 'list-wrapper',
//                    'id' => 'list-wrapper',
//                ],
//                //        'layout' => "{pager}\n{items}\n{summary}",
//                'layout' => "{pager}\n{items}",
//                'itemView' => function ($model, $key, $index, $widget) {
//            return $this->render('_basket_item_template', ['model' => $model]);
//        },
//                'itemOptions' => [
//                    'tag' => false,
//                ],
//                'pager' => [
//                    'firstPageLabel' => 'first',
//                    'lastPageLabel' => 'last',
//                    'nextPageLabel' => 'next',
//                    'prevPageLabel' => 'previous',
//                    'maxButtonCount' => 3,
//                ],
//            ]);
            ?>
        </div>

    </div>
    <!--            <div class="pull-right">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-lg-6 col-md-6">
    <?= Html::a('Checkout', ['orders/checkout'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>-->
</div>


<div class="modal fade" id="modal-venue-content" role="dialog">
    <div class="modal-dialog venue-list-load-dialog">
            <div class="modal-content">
                <div>
                    <button type="button" class="close close-dialog-button" data-dismiss="modal">&times;</button>
                    <h4 class="text-align-center">Venue</h4>
                    <input type="hidden" class="order-id-val-for-venue">
                </div>
                <div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input type="text" placeholder="Search for venues" class="form-control venue-dialog-search">
                    </div>
    <!--                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <button class="btn btn-primary venue-dialog-search-button">Search</button>
                    </div>-->
                </div>
                <div class="venue-list-area">

                </div>
                <div class="modal-footer border-none">
                </div>
            </div>
    </div>
</div>

<div class="modal fade" id="modal-food-content" role="dialog">
    <div class="modal-dialog food-list-load-dialog">
        <div class="modal-content" style="padding: 10px;">
            <div>
                <button type="button" class="close close-dialog-button" data-dismiss="modal">&times;</button>
                <h4 class="text-align-center">Food</h4>
            </div>
            <div>
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <input type="text" placeholder="Search for food" class="form-control food-dialog-search">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <button class="btn btn-primary food-dialog-search-button">Search</button>
                </div>
            </div>
            <div class="food-list-area">
                
            </div>
            <div class="modal-footer border-none">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-product-content" role="dialog">
    <div class="modal-dialog product-list-load-dialog">
        <div class="modal-content" style="padding: 10px;">
            <div>
                <button type="button" class="close close-dialog-button" data-dismiss="modal">&times;</button>
                <h4 class="text-align-center">Product</h4>
            </div>
            <div>
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <input type="text" placeholder="Search for product" class="form-control product-dialog-search">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <button class="btn btn-primary product-dialog-search-button">Search</button>
                </div>
            </div>
            <div class="product-list-area">
                
            </div>
            <div class="modal-footer border-none">
            </div>
        </div>
    </div>
</div>