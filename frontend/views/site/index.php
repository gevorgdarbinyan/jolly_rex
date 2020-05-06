<style>
    .ml6 {
  position: relative;
  font-weight: 900;
  font-size: 3.3em;
}

.ml6 .text-wrapper {
  position: relative;
  display: inline-block;
  padding-top: 0.2em;
  padding-right: 0.05em;
  padding-bottom: 0.1em;
  overflow: hidden;
}

.ml6 .letter {
  display: inline-block;
  line-height: 1em;
}
</style>
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Jolly Rex';

$this->registerCssFile("@web/css/site/index.css");
if (Yii::$app->user->identity) {
    $this->registerJs("
        var busyDays = JSON.parse('".$busyDays."');
    ",View::POS_HEAD);
}
?>
<?php
//$this->registerJsFile('@web/js/site/index.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?php if(!isset($userType) || $userType == 'Customer'): ?>
<div class="" style="background: url('<?= Yii::$app->request->baseUrl; ?>/images/background_img_10.png') no-repeat; background-size: 100%; height: 635px;">
    
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1" style="margin-top: 10%;">
        <?= Html::img('@web/images/tree01.png', ['width' => '85%']); ?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2" style="margin-top: 7%;">
        <?= Html::img('@web/images/tree02.png', ['width' => '85%', 'class' => 'pull-right']); ?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="margin-top: 6%;">
        <?= Html::img('@web/images/dragon.png', ['width' => '80%', 'style' => 'margin-left: -24%;']); ?>
    </div>
    
</div>

<div class="pull-right" style="margin-top: -190px; position: fixed; right: 0; z-index: 10000;">
    <h1 class="ml6" style="color:red;font-size:21px;text-align:center;">
    <span class="text-wrapper">
        <span class="letters">PRESS ON ME</span>
    </span>
    </h1>
    <?= Html::a(Html::img('@web/images/jolly-rex-survey.png'), ['survey/index'],[]); ?></a>
</div>
<?php endif;?>

<?php if ((isset($userData) && $userData['user_type_name'] == 'Customer') || Yii::$app->user->isGuest) { ?>
<div class="welcome-text1">
    Hello, I am Jolly Rex! Welcome to my Kingdom of Fun! <br />
    Here in one place you can find children’s entertainers, venues, party food,<br /> presents and party products - 
    everything you need for your amazing, fun party.<br />
    Sign up and become the honorary citizen of my Kingdom!
</div>
<?php } ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
</div>
<div class="container-fluid">
    <?php if ((isset($userData) && $userData['user_type_name'] == 'Customer') || Yii::$app->user->isGuest) { ?>
        <div class="row vendors">
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <a href="<?= Yii::$app->urlManager->createUrl(['entertainers/index']); ?>">
                    <button class="navi_btn" id="entertainer">
                        <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/entertainer-icon.png">
                    </button>
                    <span class="supplier-label">ENTERTAINER</span>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <a href="<?= Yii::$app->urlManager->createUrl(['venue/index']); ?>">
                    <button class="navi_btn" id="venue">
                        <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/venue-icon.png">
                    </button>
                    <span class="supplier-label">VENUE</span>
                </a>
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <a href="<?= Yii::$app->urlManager->createUrl(['food/providers']); ?>">
                    <button class="navi_btn" id="catering">
                        <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/catering-icon.png">
                    </button>
                    <span class="supplier-label">PARTY FOOD</span>
                </a>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <a href="<?= Yii::$app->urlManager->createUrl(['product/providers']); ?>">
                    <button class="navi_btn" id="party_products">
                        <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/party-products-icon.png">
                    </button>
                    <span class="supplier-label">PARTY PRODUCTS</span>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <a href="<?= Yii::$app->urlManager->createUrl(['photographer/index']); ?>">
                    <button class="navi_btn" id="photographer">
                        <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/photographer.png">
                    </button>
                    <span class="supplier-label">PHOTOGRAPHER</span>
                </a>
            </div>
        </div>
    <?php } ?>
</div>

<div class="container-fluid">
    <?= (!empty($userTypeWidget)) ? $userTypeWidget : '';?>
</div>
<!-- <audio id="music" autoplay>
  <source src="/images/search-audio.mp3" type="audio/mpeg">
</audio> -->

<!-- <audio autoplay id="music">
      <source src="/images/search-audio.mp3">
</audio> -->