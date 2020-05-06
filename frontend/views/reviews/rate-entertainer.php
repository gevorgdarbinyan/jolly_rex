<?php
use kartik\rating\StarRating;
use yii\widgets\ActiveForm;
?>
<style>
    .wrapper {
        /* display: flex; */
        align-items: stretch;
        background-color: #FFFFFF;
        border-radius: 20px;
        margin: 50px;
        padding: 50px 20px 20px 20px;
}
</style>
<div class="container-fluid">
    <div class="wrapper">
        <h1 class="text-center" style="color:#337ab7;">We Appreciate Your Reviews!</h1>
        <?php $form = ActiveForm::begin(['action'=>'/reviews/thank-you']); ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label style="font-size: 25px;color:#337ab7;">Entertainer(s)</label>
                <?php
                    echo StarRating::widget([
                        'name' => 'Reviews[entertainers_point]',
                        'class' => 'entertainers-class',
                        'pluginOptions' => ['disabled'=>false, 'showClear'=>false, 'size'=>'lg'],
                       
                    ]);
                ?>
            </div>
        </div>
        <div class="row" style="margin-top: 50px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label style="font-size: 25px;color:#337ab7;">Overall Program</label>
                <?php
                    echo StarRating::widget([
                        'name' => 'Reviews[overall_program_point]',
                        'class' => 'overall-program-class',
                        'pluginOptions' => ['disabled'=>false, 'showClear'=>false]
                    ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group" style="margin-top: 40px;">
                    <label style="font-size:25px;color:#337ab7;">Comments</label>
                    <textarea name="Reviews[comment]"cols="30" rows="7" class="form-control" placeholder="Optional"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group" style="margin-top: 25px;">
                    <input type="checkbox" name="Reviews[keep_anonymous]" /><label style="color:#337ab7;">&nbsp;Keep anonymous</label>
                </div>
            </div>
        </div>
        <div class="row">
            <input type="hidden" name="Reviews[customer_id]" value="<?=$customer;?>"/>
            <input type="hidden" name="Reviews[entertainer_id]" value="<?=$entertainer;?>"/>
            <input type="hidden" name="Reviews[order_id]" value="<?=$order;?>"/>
            <div class="buttons pull-right">
                <button class="btn btn-success" style="background-color: #11da17;border-color: #11da17;font-size: 23px;margin-right: 71px;">Rate</button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>