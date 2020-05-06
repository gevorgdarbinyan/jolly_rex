<?php

    use yii\helpers\Html;

?>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <img class="img-circle" src="/images/Layer.jpg" width="70%" alt="">
</div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <p>
            <?php $supportsInstantBooking = $order->entertainer_relation->support_instant_booking ? '<span class="glyphicon glyphicon-ok-circle" style="color: #4CAF50; cursor: default;" title="Supports instant booking"></span>' : '' ?>
            <?= Html::a('<h5 class="entertainer-heading-title">' . $order->entertainer_relation->name . '</h5>', ['entertainers/page', 'id' => $order->entertainer_relation->id, 'oID' => $order->id], ['style' => 'text-decoration: none;']); ?> 
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
        <p style="color: #1c1c92;">
            <?php
            $date = new DateTime($entertainerOrders->event_date);
            $eventDate = $date->format('l, F d, Y');
            ?>
            <strong><?= $eventDate; ?></strong><br />
            <?php 
                $startTimeObj = new DateTime($entertainerOrders->start_time);
                $startTime = $startTimeObj->format('H:i');

                $endTimeObj = new DateTime($entertainerOrders->end_time);
                $endTime = $endTimeObj->format('H:i');
            ?>
            <?= $startTime . ' - ' . $endTime; ?><br />
            <?= $entertainerOrders->entertainers_count; ?> entertainer(s)
        </p>
        <p>
            <a href="<?= Yii::$app->urlManager->createUrl(['entertainers/page', 'id' => $order->entertainer_relation->id,'mode'=>'edit']); ?>" class="btn btn-default" style="height: 25px;padding: 3px; width: 58px;">
                <span>Amend</span>
            </a>
            &nbsp;
            <button class="btn btn-default cancel-entertainer" type="button" title="Cancel" data-entertainer-id="<?=$order->entertainer_relation->id;?>" data-order-id="<?=$order->id;?>" style="height: 25px;padding: 3px; width: 58px;">
                <span>Cancel</span>
            </button>
        </p>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <p style="margin-top:116px;">
            <h4>£ 200.00</h4>
        </p>
    </div>
</div>