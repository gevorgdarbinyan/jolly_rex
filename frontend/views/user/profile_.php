<?php

use Yii;
use yii\web\View;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile("@web/css/user/profile.css");
$this->registerJsFile('@web/js/user/profile.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="container">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="user-profile-page">
            <div class="row" style="margin-top: -43px;">
                <?= Html::img('/images/bracket-full.png', ['style' => 'width: 100%; height: 45px;']); ?>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h3><?= $userData->first_name . ' ' . $userData->last_name ?></h3>
                </div>
            </div>
            <div class="row">
                <?php ActiveForm::begin(['method' => 'post', 'action' => ['/user/upload-user-photo'], 'options' => ['enctype' => 'multipart/form-data']]); ?>
                    <?= Html::beginTag('div', ['class' => 'form-group']); ?>
                        <?= Html::fileInput('userPhoto'); ?>
                    <?= Html::endTag('div'); ?>
                    <?= Html::submitButton('Upload', ['class' => 'btn btn-default']); ?>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-link change-password-btn">
                        Change Password <span class="glyphicon glyphicon-lock"></span>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-link change-email-btn">
                        Change Email <span class="glyphicon glyphicon-envelope"></span>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-link change-personal-info-btn">
                        Change Personal Info <span class="glyphicon glyphicon-user"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
Modal::begin([
    'id' => 'change-password-modal',
    'size' => 'modal-lg',
]);
echo '<div id="changePasswordContent" style="min-height: 300px;">';
echo $this->render('/user/_change_password_template');
echo '</div>';
Modal::end();
?>

<?php
Modal::begin([
    'id' => 'change-email-dialog',
    'size' => 'modal-lg',
]);
echo '<div id="changeEmailContent" style="min-height: 300px;">';
echo $this->render('/user/_change_email_template');
echo '</div>';
Modal::end();
?>

<?php
Modal::begin([
    'id' => 'change-personal-info-dialog',
    'size' => 'modal-lg',
]);
echo '<div id="changePersonalInfoContent" style="min-height: 300px;">';
echo $this->render('/user/_change_personal_info_template', ['userData' => $userData]);
echo '</div>';
Modal::end();
?>