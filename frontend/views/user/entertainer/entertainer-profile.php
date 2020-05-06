<?php

use yii\web\View;
use yii\helpers\Html;

$this->registerCssFile("@web/css/user/profile.css");
$this->registerJsFile('@web/js/user/profile/entertainer-profile.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="user-profile-page-sidebar" style="min-height: 1000px;">
<!--                <div class="row" style="margin-top: -43px;">
                    <?= Html::img('/images/bracket-sm.png', ['style' => 'width: 100%; height: 45px;']); ?>
                </div>-->
                
                <div class="user-profile-page-sidebar-content">
                    <div class="row">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="userPersonalInfoHeading">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#userPersonalInfoBlock" aria-expanded="false" aria-controls="userPersonalInfoBlock">
                                            Personal Info
                                            <span class="glyphicon glyphicon-menu-down pull-right"></span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="userPersonalInfoBlock" class="collapse">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <button type="button" class="btn btn-link change-password-btn">
                                                    <span class="glyphicon glyphicon-lock"></span> Change Password
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <button type="button" class="btn btn-link change-email-btn">
                                                    <span class="glyphicon glyphicon-envelope"></span> Change Email
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <button type="button" class="btn btn-link change-personal-info-btn">
                                                    <span class="glyphicon glyphicon-user"></span> Change Personal Info
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="userPersonalInfoHeading">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#userOrdersBlock" aria-expanded="false" aria-controls="userOrdersBlock">
                                            Orders
                                            <span class="glyphicon glyphicon-menu-down pull-right"></span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="userOrdersBlock" class="collapse">
                                    <div class="panel-body">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="user-profile-page" style="min-height: 1000px;">
<!--                <div class="row" style="margin-top: -43px;">
                    <?= Html::img('/images/bracket-lg.png', ['style' => 'width: 100%; height: 45px;']); ?>
                </div>-->
                <div class="user-profile-page-content">
                </div>
            </div>
        </div>
    </div>
</div>