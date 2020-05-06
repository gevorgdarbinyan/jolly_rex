<?php

use yii\helpers\Html;

Yii::$app->params['count'] ++;
?>

<?php

//if (!isset($lastDivClass)) {
    if (Yii::$app->params['count'] % 2 == 0) {
        $blockClass = 'homepage-search-list-block col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2';
    } else {
        $blockClass = 'homepage-search-list-block col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1';
    }
//} elseif (isset($lastDivClass)) {
//    if ($lastDivClass == 'homepage-search-list-block col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2') {
//        if (Yii::$app->params['count'] % 2 == 0) {
//            $blockClass = 'homepage-search-list-block col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2';
//        } else {
//            $blockClass = 'homepage-search-list-block col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1';
//        }
//    } else {
//        if (Yii::$app->params['count'] % 2 == 0) {
//            $blockClass = 'homepage-search-list-block col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1';
//        } else {
//            $blockClass = 'homepage-search-list-block col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2';
//        }
//    }
//}
?>
<div class="<?= $blockClass ?>">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <a href="<?= Yii::$app->urlManager->createUrl(['entertainers/page', 'id' => $model['id']]); ?>">
            <?= Html::img('@web/images/Layer.jpg', ['class' => 'img-circle', 'width' => '100%']); ?>
        </a>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <?php $supportsInstantBooking = $model['support_instant_booking'] == 1 ? '<span class="glyphicon glyphicon-ok-circle" style="color: #4CAF50; cursor: default;" title="Supports instant booking"></span>' : '' ?>
        <?php $link = ($supportsInstantBooking) ? 'entertainers/book' : 'entertainers/enquiry' ?>
        <?php $bookText = ($supportsInstantBooking) ? 'Book Now' : 'Send Enquiry'; ?>
        <?= Html::a('<h1 class="entertainer-heading-title">' . $model['name'] . '</h1>', [$link, 'id' => $model['id']], ['style' => 'text-decoration: none;']); ?>
        <p class="entertainer-description"><?= $model['description'] ?></p>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2 style="text-align: center;">
            <?php
            $userRating = $model['rating'];
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
            <h1 class="entertainer-price">from £: <?= (!empty($model['price'])) ? $model['price'] : ''; ?></h1>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group book-now-entertainer-block">
            <?= Html::a($bookText, [$link, 'id' => $model['id']], ['class' => 'btn btn-primary book-now-entertainer']); ?>
        </div>
    </div>
</div>

