<?php
use common\models\Entertainer;
use yii\helpers\Html;
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
                        ?>
                        <div>
                            <p>
                                <strong>
                                    <?php
                                    $user = Entertainer::findOne($review['customer_id']);
                                    echo $user['first_name'] . ' ' . $user['last_name'];
                                    ?>
                                </strong>
                            </p>
                            <p>
                                <?php echo $review['comment']; ?>
                            </p>
                        </div>
                        <?php
                    }
                    ?>
                    <hr/>
                    <?php if (empty($customerOwnReview)): ?>
                        <div id="feedback-container">
                            <div class="form-group">
                                <?= Html::label('Comment'); ?>
                                <?= Html::textarea('Reviews[comment]', '', ['class' => 'form-control review-comment', 'placeholder' => 'Please give a feedback...']); ?>
                            </div>
                            <div class="form-group">
                                <?= Html::button('Give feedback', ['class' => 'btn btn-primary give-feedback-for-review', 'rel' => $entertainerID]); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>