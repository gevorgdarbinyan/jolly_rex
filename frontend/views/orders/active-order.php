<?php

//out($order);
use common\models\entertainer\EntertainerOrders;
use common\models\Venue;
use common\models\venue\VenueOrders;
use yii\helpers\Html;
$this->registerCssFile("@web/css/venue/page.css");
?>
<div class="container-fluid">
    <div class="venue-page">

         <?php if(!empty($order)): ?>
    <?php $orderID = $order->id;?>
        <div class="entertainer-block col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php 
            $entertainerOrders = EntertainerOrders::find()->where(['order_id'=>$order->id])->one();
            $venueData = Venue::findOne($order->venue_id);
            $venueOrders = VenueOrders::find()->where(['venue_id'=>$order->venue_id,'order_id'=>$order->id])->one();
            ?>
            <div class="row" style=" margin-top: -19px;">
                <img src="/images/bracket-lg.png" style="width: 100%; height: 25px;"></div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <?= Html::img('@web/images/Layer.jpg', ['class' => 'img-circle', 'width' => '100%']); ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <p>
                            <?php $supportsInstantBooking = $order->entertainer_relation->support_instant_booking ? '<span class="glyphicon glyphicon-ok-circle" style="color: #4CAF50; cursor: default;" title="Supports instant booking"></span>' : '' ?>
                            <?= Html::a('<h5 class="entertainer-heading-title">' . $order->entertainer_relation->name . ' ' . $supportsInstantBooking . '</h5>', ['entertainers/page', 'id' => $order->entertainer_relation->id,'oID'=>$order->id], ['style' => 'text-decoration: none;']); ?> 
                        </p>
                        <p>
                            <?php
                            $userRating = $order->entertainer_relation->rating;
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $userRating) {
                                    ?>
                                    <span class="glyphicon glyphicon-star rating-stars-yellow"></span>
                                    <?php
                                } else {
                                    ?>
                                    <span class="glyphicon glyphicon-star rating-stars-grey"></span>
                                    <?php
                                }
                            }
                            ?>
                        </p>
                        <p>
                            <?php
                                $date = new DateTime($entertainerOrders->event_date);
                                $eventDate = $date->format('D,M d Y');
                            ?>
                            <strong><?=$eventDate;?></strong><br />
                            <?=$entertainerOrders->start_time.'-'.$entertainerOrders->end_time;?><br />
                            <?=$entertainerOrders->entertainers_count;?> entertainer(s)
                        </p>
                        <p><a href="<?= Yii::$app->urlManager->createUrl(['entertainers/page', 'id' => $order->entertainer_relation->id,'oID'=>$order->id]); ?>">Change entertainer</a></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ml-2" id="venue-block">
                    <?=$this->render('/venue/venue-block',['venueOrders'=>$venueOrders,'orderData'=>$order]);?>
                </div>
            </div>
            <div>
            <a href="<?= Yii::$app->urlManager->createUrl(['orders/basket', 'oID'=>$order->id]); ?>">Go to basket</a>
            </div>
        </div>
    <?php endif;?>