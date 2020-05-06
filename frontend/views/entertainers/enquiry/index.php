<?php

use common\models\User;
use common\models\Entertainer;
use yii\helpers\Html;
use yii\web\View;
use kartik\datetime\DateTimePicker;
use \yii2fullcalendar\yii2fullcalendar;
use kartik\time\TimePicker;
use frontend\components\SlideshowWidget;
use yii\helpers\ArrayHelper;
use common\models\PartyType;
use yii\bootstrap\Modal;

$this->registerCssFile("@web/css/entertainers/enquiry/index.css");
$this->registerJsFile('@web/js/entertainer/enquiry/index.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = $userData['name'] . ' entertainer page';
?>
<div class="container-fluid">
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 calendar_class">
            <nav id="sidebar">
                <?= $this->render('_sidebar', ['entertainerData' => $entertainerData,'geoLocations'=>$geoLocations,'entertainerExtraThemeServices'=>$entertainerExtraThemeServices,'entertainerAdditionalProductsServices'=>$entertainerAdditionalProductsServices,'entertainerBranchesData'=>$entertainerBranchesData]);?>
            </nav>
        </div>

        <!-- Page Content Holder -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 info_class">
            <div id="content">
                <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                    <i class="glyphicon glyphicon-align-left"></i>
                    <span>Enlarge</span>
                </button>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?= $this->render('../_main_info', ['userData' => $userData]); ?>
                    <?= $this->render('../_video', ['userData' => $userData]); ?>
                    <?= $this->render('../_description', ['userData' => $userData]); ?>
                    <?= $this->render('../_party_theme', ['entertainerPartyThemes' => $entertainerPartyThemes]); ?>
                    <?= $this->render('../_price_description', ['userData' => $userData]); ?>
                    <?= $this->render('../_gallery', []); ?>
                    <?= $this->render('../_staff', ['entertainerStaff' => $entertainerStaff]); ?>
                    <?= $this->render('../_about_us', ['supplierReviews' => $supplierReviews, 'entertainerID' => $entertainerID,'adminReviews'=>$adminReviews]); ?>
                    <?= $this->render('../_geo_locations', ['geoLocations'=>$geoLocations]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

Modal::begin([
    'id' => 'entertainer-count-via-extra-guest-count-modal',
    'size' => 'modal-md',
    'header' => '<h3 style="color:red;">Warning</h3>'
]);?>
<div id="entertainer-count-via-extra-guest-count-modal-content">
</div>
<?php Modal::end();?>


<?php

Modal::begin([
    'id' => 'entertainer-count-via-extra-guest-count-extra-theme-modal',
    'size' => 'modal-md',
    'header' => '<h3 style="color:red;">Warning</h3>'
]);?>
<div id="entertainer-count-via-extra-guest-count-extra-theme-modal-content">
</div>
<?php Modal::end();?>
