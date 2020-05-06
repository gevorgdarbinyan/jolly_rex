<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

//$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/css/site/login.css');
?>
<div class="site-login">

    
    <?php $mainContainerClass = ($this->context->route == 'site/login') ? 'col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2 login-register-main-container' : 'col-lg-12 col-md-12 col-sm-12 col-xs-12' ?>
    <?php $class = ($this->context->route == 'site/login') ? 'col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2' : 'col-lg-12 col-md-12 col-sm-12 col-xs-12' ?>
    <div class="<?= $mainContainerClass ?>">
        <?php if ($this->context->route == 'site/login') { ?>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-offset-4 col-md-offset-4">
            <img src="/images/login_gate.png" class="login-page-gate-image">
        </div>
        <?php } ?>
        <div class="<?= $class ?>">

            <p>Please fill out the following fields to login:</p>

            <?php $form = ActiveForm::begin(['action' => '/site/login', 'id' => 'login-form']); ?>

            <div class="input-for-login-signup">
                <i class="glyphicon glyphicon-user" aria-hidden="true"></i>
                <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false); ?>
            </div>

            <div class="input-for-login-signup">
                <i class="glyphicon glyphicon-lock" aria-hidden="true"></i>
                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false); ?>
            </div>
            <div class="input-for-login-signup">
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3 col-md-3">{image}</div><div class="col-lg-1 col-md-1"><button type="button" class="btn btn-link refresh-captcha-image"><span class="glyphicon glyphicon-refresh"></span></button></div><div class="col-lg-8 col-md-8"><i class="glyphicon glyphicon-picture" aria-hidden="true"></i>{input}</div></div>',
                ]) ?>
            </div>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
            </div>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary login_btn', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        
        </div>
        
    </div>
</div>
