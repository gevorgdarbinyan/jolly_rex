<?php
use common\models\entertainer\EntertainerOrders;
use common\models\Venue;
use common\models\venue\VenueOrders;
use yii\helpers\Html;
use yii\web\View;

$this->registerCssFile("@web/css/active-order-line/active-order-line.css");
$this->registerJsFile('@web/js/orders/active-order-line.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?php if(!empty($order)): ?>
<?php $orderID = $order['id'];?>
    <!--<div class="entertainer-block col-lg-12 col-md-12 col-sm-12 col-xs-12">-->
    <div class="active-order-line-block col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php 
        $entertainerOrders = EntertainerOrders::find()->where(['order_id'=>$orderID])->one();
        $venueData = Venue::findOne($order['venue_id']);
        $venueOrders = VenueOrders::find()->where(['venue_id'=>$order['venue_id'],'order_id'=>$orderID])->one();
        ?>
        <div class="row" style=" margin-top: -19px;">
            <img src="/images/bracket-lg.png" style="width: 100%; height: 25px;">
        </div>
        <div class="row">
            <button type="button" class="btn btn-link active-order-line-show-hide"><span class="glyphicon glyphicon-chevron-up"></span></button>
        </div>
        <div class="row order-line-block">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?=$this->render('entertainer-block',['entertainerOrders'=>$entertainerOrders,'order'=>$order])?>
            </div>
            <?php if($order['venue_id']): ?>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ml-2" id="venue-block">
                    <?=$this->render('venue-block',['venueOrders'=>$venueOrders,'order'=>$order]);?>
                </div>
            <?php endif;?>
        </div>
        <div>
        <a href="<?= Yii::$app->urlManager->createUrl(['orders/basket', 'oID'=>$order['id']]); ?>">Go to basket</a>
        </div>
    </div>
<?php endif;?>
