<?php
use yii\helpers\Html;
?>
<div>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="ourStaffBlockHeading">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" href="#ourStaffBlock" aria-expanded="false" aria-controls="ourStaffBlock">
                        Our Staff
                        <span class="glyphicon glyphicon-plus pull-right"></span>
                    </a>
                </h4>
            </div>
            <div id="ourStaffBlock" class="fade collapse">
                <div class="panel-body">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border entertainer-page-titles">Our Staff</legend>
                        <?php
                        foreach ($entertainerStaff as $staff) {
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <h4><?= $staff->first_name . ' ' . $staff->last_name; ?></h4>
                                <?= Html::img('@web/images/Layer.jpg', ['class' => 'img-circle']); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>