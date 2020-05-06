<?php

use yii\helpers\Html;
?>

<div class="row orders-row">
    <div style="margin: 0 auto; padding: 20px;">
        <div class="col-lg-5 col-md-5">
            <div>
                <?= $model->partyType_relation->name; ?>
            </div>
            <div>
                <?= Html::a($model->entertainer_relation->name,['entertainers/page','id'=>$model->entertainer_relation->id]); ?>
            </div>
            <div>
                <?= $model->price ?>
            </div>
            <div>
                <?= $model->special_request ?>
            </div>
            <div>
                <?= $model->event_date ?>
            </div>
            <div>
                <?= $model->start_time ?>
            </div>
            <div>
                <?= $model->end_time ?>
            </div>
            <div>
                <?php if ($model->status == 'Pending') { ?>
                    <span class="glyphicon glyphicon-arrow-up" style="color:red;" title="Pending"></span>
                <?php } else { ?>
                    <span class="glyphicon glyphicon-ok" style="color:green;" title="Approved"></span>
                <?php } ?>
            </div>
            <div class="form-group">
                <button class="btn btn-default choose_venue_btn">Choose Venue</button>
            </div>
            <div class="form-group">
                <button class="btn btn-default choose_venue_btn">Buy Food/Cake</button>
            </div>
            <div class="form-group">
                <button class="btn btn-default choose_venue_btn">Buy Product/Decoration</button>
            </div>
        </div>
        <div class="col-lg-5 col-md-5" id="selected_venue_block">
            
        </div>

    </div>
</div>