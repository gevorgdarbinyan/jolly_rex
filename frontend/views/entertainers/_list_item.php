<?php

use yii\helpers\Html;
use common\models\entertainer\EntertainerServices;

Yii::$app->params['count'] ++;
?>

<?php
if (Yii::$app->params['count'] % 2 == 0) {
    $blockClass = 'entertainer-list-block col-lg-5 col-md-5 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2';
} else {
    $blockClass = 'entertainer-list-block col-lg-5 col-md-5 col-sm-12 col-xs-12';
}
?>
<div class="<?= $blockClass ?>">
    <div class="row" style="margin-top: -37px;"><img src="/images/bracket-sm.png" style="width: 100%; height: 25px;"></div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <a href="<?= Yii::$app->urlManager->createUrl(['entertainers/page', 'id' => $model->id]); ?>">
            <?= Html::img('@web/images/Layer.jpg', ['class' => 'img-circle', 'width' => '100%']); ?>
        </a>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <?php $supportsInstantBooking = $model->support_instant_booking ? '<span class="glyphicon glyphicon-ok-circle" style="color: #4CAF50; cursor: default;" title="Supports instant booking"></span>' : '' ?>
        <?php $link = ($supportsInstantBooking) ? 'entertainers/book' : 'entertainers/enquiry' ?>
        <?php $bookText = ($supportsInstantBooking) ? 'Book Now' : 'Send Enquiry'; ?>
        <?= Html::a('<h1 class="entertainer-heading-title">' . $model->name . ' ' . $supportsInstantBooking . '</h1>', [$link, 'id' => $model->id], ['style' => 'text-decoration: none;']); ?>
        <p class="entertainer-description"><?= $model->short_description ?></p>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2 style="text-align: center;">
            <?php
            $userRating = $model->rating;
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
        </h2>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1 class="entertainer-price">from £: <?= EntertainerServices::getMinimumPrice($model->id); ?></h1>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group book-now-entertainer-block">
            <?= Html::a($bookText, [$link, 'id' => $model->id], ['class' => 'btn btn-primary book-now-entertainer']); ?>
        </div>
    </div>
</div>

