<?php

use yii\web\View;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="user-profile-background">
        <!--<div class="col-lg-3 col-md-3">-->
            <!-- <img src="/images/account-figure-1.png" width="20%"> -->
        <!--</div>-->
        <!--<div class="col-lg-3 col-md-3">-->
            <!-- <img src="/images/account-figure-3.png" width="25%"> -->
        <!--</div>-->
        <!--<div class="col-lg-6 col-md-6">-->
            <!-- <img src="/images/account-figure-5.png" width="50%"> -->
        <!--</div>-->
        <!-- <img src="/images/background/account-header-pre-final-cut.png" /> -->
        <!-- <img src="/images/background/account-header-pre-final-cut.png" /> -->
<!--    <div class="my-personal-details-div">

    </div>-->
    <div id="personal-details-link">
    </div>
    <div id="my-enquiries-link">
    </div>
    <div id="my-orders-link">
    </div>
</div>
<hr />
<div class="confirmation-background">
</div>
<?php
//    echo $html;
?>


<?php
Modal::begin([
    'id' => 'status-info-dialog',
    'size' => 'modal-lg',
]);
echo '<div id="statusModalContent" style="min-height: 300px;">';
echo '</div>';
Modal::end();

Modal::begin([
    'id' => 'user-personal-details-modal',
    'size' => 'modal-lg',
]);
    echo '<div>';
        echo $userProfilePersonalDetailsWidget;
    echo '</div>';
Modal::end();

Modal::begin([
    'id' => 'user-my-orders-modal',
    'size' => 'modal-lg',
]);
    echo '<div>';
        echo $userProfileMyOrdersWidget;
    echo '</div>';
Modal::end();

Modal::begin([
    'id' => 'user-my-enquiries-modal',
    'size' => 'modal-lg',
]);
    echo '<div>';
        echo $userProfileMyEnquiriesWidget;
    echo '</div>';
Modal::end();
?>