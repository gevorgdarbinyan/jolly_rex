<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

$this->registerCssFile("@web/css/profile/profile-site.css", ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
?>

<?php $this->beginBlock('sign-up-block'); ?>
<div class="modal fade" id="sign-up-form-modal" role="dialog">
    <div class="modal-dialog modal-dialog-for-login-signup">
        <div class="modal-content">
            <div>
                <button type="button" class="close close-dialog-button" data-dismiss="modal">&times;</button>
                <h4 style="text-align: center;">Please fill fields to be registrated in site</h4>
            </div>
            <div>
                <div class="sign-up-form-area">
                    <?=
                    $this->render('/site/signup', [
                        'model' => new frontend\models\SignupForm()
                    ]);
                    ?>
                </div>
            </div>
            <div class="modal-footer border-none">
            </div>
        </div>
    </div>
</div>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('login-block'); ?>
<div class="modal fade" id="log-in-form-modal" role="dialog">
    <div class="modal-dialog modal-dialog-for-login-signup">
        <div class="modal-content">
            <div>
                <button type="button" class="close close-dialog-button" data-dismiss="modal">&times;</button>
                <h3 style="text-align: center;">Login</h3>
            </div>
            <div>
                <div class="login-form-area">
                    <?=
                    $this->render('/site/login', [
                        'model' => new common\models\LoginForm()
                    ]);
                    ?>
                </div>
            </div>
            <div class="modal-footer border-none">
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="login-signup-links-modal" role="dialog">
    <div class="modal-dialog modal-dialog-for-login-signup">
        <div class="modal-content">
            <div>
                <button type="button" class="close close-dialog-button" data-dismiss="modal">&times;</button>
            </div>
            <div class="login-signup-status-modal-content">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 30px 90px;">
                    <div class="form-group" style="text-align: center;">
                        <h4><b>Please sign up if you don't have an account</b></h4>
                        <button id="sign_up" type="button" class="btn btn-success">
                            Sign up
                        </button>
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <h4><b>Already registered?</b></h4>
                        <button id="log_in" type="button" class="btn btn-success">
                            Log in
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-none">
            </div>
        </div>
    </div>
</div>


<?php $this->endBlock(); ?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>

        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?=$this->render('./header', []);?>
        <!--<div class="container">-->
        <?= $content ?>
        <!--</div>-->
        
        <!-- Profile footer here -->

        <?php $this->registerJs('window.App = { base_path : "' . Yii::$app->getHomeUrl() . '"}', \yii\web\View::POS_BEGIN); ?>
        <?php $this->endBody() ?>

        <?= $this->blocks['sign-up-block']; ?>
        <?= $this->blocks['login-block']; ?>

    </body>
</html>
<?php $this->endPage() ?>