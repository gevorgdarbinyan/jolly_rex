<?php
use common\models\entertainer\EntertainerOrders;
use common\models\Venue;
use common\models\venue\VenueOrders;
use yii\helpers\Html;

$this->registerCssFile('@web/css/orders/basket.css');
?>

<?php if(!empty($order)): 
    $entertainerOrders = EntertainerOrders::find()->where(['order_id' => $order->id])->one();
    $venueData = Venue::findOne($order->venue_id);
    $venueOrders = VenueOrders::find()->where(['venue_id' => $order->venue_id, 'order_id' => $order->id])->one();
    
    $entertainerDataStr = '';
    $venueDataStr = '';
    $foodDataStr = '';
    $productDataStr = '';
    
    if (!empty($order->entertainer_id)) {
        $entertainerDataStr .= $this->render('basket_templates/_basket_entertainer', ['order' => $order, 'entertainerOrders' => $entertainerOrders]);
    }
    if (!empty($order->venue_id)) {
        $venueDataStr .= $this->render('basket_templates/_basket_venue', ['order' => $order, 'venueData' => $venueData, 'venueOrders' => $venueOrders]);
    }
    if (!empty($order->food_id)) {
        $foodDataStr .= 'Food template';
    }
    if (!empty($order->product_id)) {
        $productDataStr .= 'Product template';
    }
?>
<div class="container">
    <div style="margin-top: 80px;">

    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basket_template_lg">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="margin-top:30px; padding: 0px;">
                <div class="col-lg-12 col-md-12" style="padding: 0px;">
                    <?= (!empty($order->entertainer_id)) ? $entertainerDataStr : ''; ?>
                </div>

                <div class="col-lg-12 col-md-12" style="margin-top: 30px; padding: 0px;">
                    <?= (!empty($order->venue_id)) ? $venueDataStr : ''; ?>
                </div>

                <div class="col-lg-12 col-md-12">
                    <?= (!empty($order->food_id)) ? $foodDataStr : ''; ?>
                </div>

                <div class="col-lg-12 col-md-12">
                    <?= (!empty($order->product_id)) ? $productDataStr : ''; ?>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div class="col-lg-12 col-md-12 basket_template_md well pull-right" style="background: #ffffcc; margin-top:30px;border: 1px solid #ffff00;border-radius:15px;padding:0;">
                    <div class="col-lg-12 col-md-12 food_droduct_basket_blocks" style="margin-top: 60px;margin-left:7px;">
                        <?php if (empty($order->entertainer_id)) { ?>
                            <p>
                                <a href="" class="basket-need-entertainer-text-class btn btn-default" style="font-size: 16px !important;">I need entertainers</a>
                            </p>
                        <?php } ?>

                        <?php if (empty($order->venue_id)) { ?>
                            <p style="margin-top: 20px;">
                                <a href="" class="basket-need-venue-text-class btn btn-default" style="font-size: 16px !important;">I need venues</a>
                            </p>
                        <?php } ?>

                        <?php if (empty($order->food_id)) { ?>
                            <p style="margin-top: 20px;">
                                <a href="" class="basket-need-food-text-class btn btn-default" style="font-size: 16px !important;">I need party food</a>
                            </p>
                        <?php } ?>

                        <?php if (empty($order->product_id)) { ?>
                            <p style="margin-top: 20px;">
                                <a href="" class="basket-need-product-text-class btn btn-default" style="font-size: 16px !important;">I need party products</a>
                            </p>
                        <?php } ?>
                    </div>
                    <div class="col-lg-12 col-md-12 food_droduct_basket_block">

                    </div>

                </div>
            </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-12 col-md-12 well" style="background-color: #e6f7ff;border-radius: 18px;color: #1c1c92;margin-top:20px;">
                        <div class="col-lg-6 col-md-6">
                        </div>
                        <div class="col-lg-4 col-md-4 text-right">
                            <h4 style="margin-right:142px;font-weight: bold;font-size: 21px;">Total: £ 300.00</h4>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <!-- <button class="btn btn-success pull-right" style="background-color: #11da17;border-color: #11da17;font-size: 20px;">
                                Checkout
                            </button> -->
                            <?= Html::a('Checkout', ['orders/checkout?oID='.$order->id], ['class' => 'btn btn-success pull-right','style'=>'background-color: #11da17;border-color: #11da17;font-size: 20px;']) ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
            </div>
        </div>
    </div>
</div>
<?php endif;?>