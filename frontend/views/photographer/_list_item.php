<?php

use yii\helpers\Html;

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
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <a href="<?= Yii::$app->urlManager->createUrl(['entertainers/page', 'id' => $model->id]); ?>">
            <?= Html::img('@web/images/Layer.jpg', ['class' => 'img-circle', 'width' => '100%']); ?>
        </a>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <?= Html::a('<h1 class="entertainer-heading-title">' . $model->first_name.' '.$model->last_name . '</h1>', ['entertainers/page', 'id' => $model->id], ['style' => 'text-decoration: none;']); ?>
    </div>
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1 class="entertainer-price">from £: <?= $model->price; ?></h1>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group book-now-entertainer-block">
            <?= Html::a('Book Now', ['entertainers/page', 'id' => $model->id], ['class' => 'btn btn-primary book-now-entertainer']); ?>
        </div>
    </div>
</div>

