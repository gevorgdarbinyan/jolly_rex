<?php

use yii\helpers\Html;

Yii::$app->params['count'] ++;
?>

<?php
if (Yii::$app->params['count'] % 2 == 0) {
    $blockClass = 'venue-list-block col-lg-5 col-md-5 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1';
} else {
    $blockClass = 'venue-list-block col-lg-5 col-md-5 col-sm-12 col-xs-12';
}
?>
<div class="<?= $blockClass ?>">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
            <a href="<?= Yii::$app->urlManager->createUrl(['venue/page', 'id' => $model->id]); ?>">
                <?= Html::img('@web/images/venueLayer.jpg', ['width' => '100%']); ?>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= Html::a('<h1 class="venue-heading-title text-align-center">' . $model->name . '</h1>', ['venue/page', 'id' => $model->id], ['style' => 'text-decoration: none;']); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="venue-description"><?= $model->short_description ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h2 class="text-align-center">
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
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="venue-price">from £: <?= $model->price ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group book-now-venue-block">
                <?= Html::a('Book Now', ['venue/page', 'id' => $model->id], ['class' => 'btn btn-primary book-now-venue']); ?>
            </div>
        </div>
    </div>
</div>