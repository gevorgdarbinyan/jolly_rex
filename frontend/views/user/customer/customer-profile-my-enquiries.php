<?php

use yii\web\View;
use yii\helpers\Html;

$this->registerCssFile("@web/css/user/profile.css");
$this->registerJsFile('@web/js/user/profile/customer-profile.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="user-profile-page-sidebar">
            <div class="user-profile-page-sidebar-content">
                <div class="row">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="userPersonalInfoHeading">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" href="#userEnquiriesBlock" aria-expanded="false" aria-controls="userOrdersBlock">
                                        My Enquiries
                                        <span class="glyphicon glyphicon-menu-down pull-right"></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="userEnquiriesBlock" class="collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <button type="button" class="btn btn-link to-confirm-enquiries-btn">
                                                To Confirm
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <button type="button" class="btn btn-link confirmed-enquiries-btn">
                                                Confirmed
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <button type="button" class="btn btn-link being-discuessed-enquiries-btn">
                                                Being discussed
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="user-profile-page">
            <div class="user-profile-page-content">
            </div>
        </div>
    </div>
</div>
