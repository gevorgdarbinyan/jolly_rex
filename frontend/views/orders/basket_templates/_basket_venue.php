<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <img class="img-circle" src="/images/venueLayer.jpg" width="80%" alt="">
</div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <p>
            <a href="" style="text-decoration: none;"></a>
        </p>
        <h5 class="entertainer-heading-title">
            <a href="" style="text-decoration: none;">Venue 1</a>
        </h5> 
        <p>
            <span class="glyphicon glyphicon-star rating-stars-yellow"></span>
            <span class="glyphicon glyphicon-star rating-stars-yellow"></span>
            <span class="glyphicon glyphicon-star rating-stars-yellow"></span>
            <span class="glyphicon glyphicon-star rating-stars-yellow"></span>
            <span class="glyphicon glyphicon-star rating-stars-yellow"></span>
        </p>
        <p style="color: #1c1c92;">
            <strong>Friday, October 18, 2018</strong><br>
            15::30 - 16:30<br>
        </p>
        <p>
            <a href="<?= Yii::$app->urlManager->createUrl(['venue/page', 'id' => $order->entertainer_relation->id,'mode'=>'edit']); ?>" class="btn btn-default" style="height: 25px;padding: 3px; width: 58px;">
                <span>Amend</span>
            </a>
            &nbsp;
            <button class="btn btn-default cancel-entertainer" type="button" title="Cancel" data-entertainer-id="<?=$order->venue_relation->id;?>" data-order-id="<?=$order->id;?>" style="height: 25px;padding: 3px; width: 58px;">
                <span>Cancel</span>
            </button>
        </p>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <p style="margin-top:95px;">
            <h4>£ 100.00</h4>
        </p>
    </div>
</div>