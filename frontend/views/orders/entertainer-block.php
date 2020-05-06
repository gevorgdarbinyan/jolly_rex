<?php
use yii\helpers\Html;
use common\models\Entertainer;

$entertainer = Entertainer::findOne($order['entertainer_id']);
?>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <?= Html::img('@web/images/Layer.jpg', ['class' => 'img-circle', 'width' => '100%']); ?>
</div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <p>
        <?php $supportsInstantBooking = $entertainer['support_instant_booking'] ? '<span class="glyphicon glyphicon-ok-circle" style="color: #4CAF50; cursor: default;" title="Supports instant booking"></span>' : '' ?>
        <?= Html::a('<h5 class="entertainer-heading-title">' . $entertainer['name'] . ' ' . $supportsInstantBooking . '</h5>', ['entertainers/amend', 'id' => $entertainer['id'],'oID'=>$order['id']], ['style' => 'text-decoration: none;']); ?> 
    </p>
    <p>
        <?php
        $userRating = $entertainer['rating'];
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
    <p>
        <a href="<?= Yii::$app->urlManager->createUrl(['entertainers/amend', 'id' => $entertainer['id'],'oID'=>$order['id']]); ?>" class="btn btn-link">
            <span class="glyphicon glyphicon-pencil" title="Amend"></span>
        </a>
        <button class="btn btn-link cancel-entertainer" type="button" title="Cancel" data-entertainer-id="<?=$entertainer['id'];?>" data-order-id="<?=$order['id'];?>">
            <span class="glyphicon glyphicon-remove"></span>
        </button>
    </p>
</div>