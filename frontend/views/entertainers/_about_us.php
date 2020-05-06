<?php
use common\models\Customer;
use yii\helpers\Html;
use kartik\rating\StarRating;
?>
<div>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="ourStaffBlockHeading">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" href="#customersAboutUsBlock" aria-expanded="false" aria-controls="customersAboutUsBlock">
                        Reviews
                        <span class="glyphicon glyphicon-plus pull-right"></span>
                    </a>
                </h4>
            </div>
            <div id="customersAboutUsBlock" class="fade collapse">
                <div class="panel-body">
                    <h3 class="entertainer-page-titles">Reviews</h3>
                    <?php
                    foreach ($supplierReviews as $review) {
                        $customer = Customer::findOne($review['customer_id']);
                        ?>
                        <div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <h6>
                                    <?=$customer['first_name'] . ' ' . $customer['last_name'];?>
                                </h6>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            Entertainer
                            <?=StarRating::widget([
                                        'name' => '',
                                        'value' => $review['entertainers_point'],
                                        'class' => 'entertainers-class',
                                        'pluginOptions' => ['displayOnly' => true,'showCaption' => false,'size' => 'sm']
                                    ]);
                            ?>
                            Overall program
                            <?=StarRating::widget([
                                        'name' => '',
                                        'value' => $review['overall_program_point'],
                                        'class' => 'overall-program-class',
                                        'pluginOptions' => ['displayOnly' => true,'showCaption' => false,'size' => 'sm']
                                    ]);
                            ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <blockquote><small><?=$review['comment']; ?></small></blockquote>
                            </div>
                        </div>
                        <?php
                    }
                    foreach($adminReviews as $review) {
                        ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h6>Administrator</h6>
                            <blockquote><small><?=$review['comment']?></small></blockquote>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>