<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use common\models\entertainer\EntertainerOrders;
?>
<div class="container" style="margin-top:50px;">
   <div class="panel-group">
    <?php foreach($orders as $order):?>
      <?php $entertainerOrders = EntertainerOrders::find()->where(['order_id'=>$order->id])->one();?>
      <div class="panel panel-success">
          <?php
            $createdDateObj = new DateTime($order->created_date);
            $createdDate = $createdDateObj->format('Y-m-d');
          ?>
        <div class="panel-heading">ORDER #<a href="<?= Yii::$app->urlManager->createUrl(['orders/basket', 'oID'=>$order->id]); ?>"><?=$createdDate.'-'.$order->id;?></a></div>
        <div class="panel-body">

            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <?= Html::img('@web/images/Layer.jpg', ['class' => 'img-circle', 'width' => '100%']); ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <p style='font-size: 19px;font-weight: 700;text-transform: uppercase;'>Entertainer</p>
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
                                $eventDateObj = new DateTime($entertainerOrders->event_date);
                                $eventDate = $eventDateObj->format('D,M d Y');
                            ?>
                            <strong><?=$eventDate;?></strong><br />
                            <?=$entertainerOrders->start_time.'-'.$entertainerOrders->end_time;?><br />
                            <?=$entertainerOrders->entertainers_count;?> entertainer(s)
                        </p>
                        <p><a href="<?= Yii::$app->urlManager->createUrl(['entertainers/page', 'id' => $order->entertainer_relation->id,'oID'=>$order->id]); ?>">Change entertainer</a></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ml-2 text-center">
                    <p style='font-size: 19px;font-weight: 700;text-transform: uppercase;'>VENUE</p>
                    <p>
                    <?php if(!empty($entertainerOrders['venue_address'])):
                         echo   $entertainerOrders['city'].' '.$entertainerOrders['venue_address'];
                    else:
                        ?>
                        <a href="<?= Yii::$app->urlManager->createUrl(['venue/index', 'oID'=>$order->id]); ?>">Venue</a>
                        <?php
                    endif;?>

                        <!-- <a href="<?= Yii::$app->urlManager->createUrl(['venue/index', 'oID'=>$order->id]); ?>">Add Venue</a> -->
                    </p>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
                    <p style='font-size: 19px;font-weight: 700;text-transform: uppercase;'>FOOD</p>
                    <p>
                        <a href="<?= Yii::$app->urlManager->createUrl(['food/providers', 'oID'=>$order->id]); ?>">Food</a>
                    </p>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
                    <p style='font-size: 19px;font-weight: 700;text-transform: uppercase;'>PRODUCT</p>
                    <p>
                        <a href="<?= Yii::$app->urlManager->createUrl(['product/providers', 'oID'=>$order->id]); ?>">Product</a>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <p>
                        Total
                    </p>
                </div>
            </div>
            <div class="text-right">
                <a href="<?= Yii::$app->urlManager->createUrl(['orders/checkout']); ?>" class="btn btn-success">Checkout</a>
            </div>

        </div>
      </div>
    <?php endforeach;?>
    </div>
</div>