<?php 
use yii\helpers\Html;
use common\models\Venue;
if(!empty($order['venue_id'])) {
    $venue = Venue::findOne($order['venue_id']);
    $venueName = $venue['name'];
    $venueID = ($order['venue_id']) ? $order['venue_id'] : 0;
    if($venueName && $venueID != 0) {
    ?>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <?= Html::img('@web/images/venueLayer.jpg', ['width' => '100%']); ?>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <p>
            <?= Html::a('<h5 class="entertainer-heading-title">' . $venueName . '</h5>', ['venue/page', 'id' => $venueID,'oID'=>$order['id']], ['style' => 'text-decoration: none;']); ?> 
        </p>
        <p>
            <?php
                $userRating = $venue['rating'];
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
                $date = new DateTime($venueOrders->event_date);
                $eventDate = $date->format('D,M d Y');
            ?>
            <strong><?=$eventDate;?></strong><br />
            <?=$venueOrders->start_time.'-'.$venueOrders->end_time;?><br />
            <strong>Total: </strong>£ <?=$venueOrders->price;?>
        </p>
        <p>
            <a href="<?= Yii::$app->urlManager->createUrl(['venue/page', 'id' => $venueID,'oID'=>$order['id']]); ?>">Change venue</a>
        </p>
    </div>
    <?php 
    }
}?>