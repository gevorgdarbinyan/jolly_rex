<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="site-signup">

    <?php $mainContainerClass = ($this->context->route == 'site/signup') ? 'col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2 login-register-main-container' : 'col-lg-12 col-md-12 col-sm-12 col-xs-12' ?>
    <?php $class = ($this->context->route == 'site/signup') ? 'col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2' : 'col-lg-12 col-md-12 col-sm-12 col-xs-12' ?>

    <div class="<?= $mainContainerClass ?>">
        <?php if ($this->context->route == 'site/signup') { ?>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-offset-4 col-md-offset-4">
            <img src="/images/login_gate.png" class="login-page-gate-image">
        </div>
        <?php } ?>
        <div class="<?= $class ?>">
            <?php $form = ActiveForm::begin(['action' => '/site/signup', 'id' => 'form-signup']); ?>
            <div class="input-for-login-signup">
                <i class="glyphicon glyphicon-user" aria-hidden="true"></i>
                <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false); ?>
            </div>

            <div class="input-for-login-signup">
                <i class="glyphicon glyphicon-lock" aria-hidden="true"></i>
                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false); ?>
            </div>

            <div class="input-for-login-signup">
                <i class="glyphicon glyphicon-lock" aria-hidden="true"></i>
                <?= $form->field($model, 'reenter_password')->passwordInput(['placeholder' => 'Password'])->label(false); ?>
            </div>

            <?= $form->field($model, 'user_type_id')->hiddenInput(['value' => 1])->label(false); ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
