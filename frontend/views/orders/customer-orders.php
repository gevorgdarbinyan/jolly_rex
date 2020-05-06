<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use Yii\web\View;

$this->registerJsFile('@web/js/orders/customer-orders.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
?>
<style>
.pending-orders-table {
        border-collapse: collapse;
        border-radius: 1em;
        overflow: hidden;
}
</style>

<?php
$partyTypesData = ArrayHelper::map($partyTypes,'id','name');
$enteratinerOrder = [];
$venueOrder = [];
foreach($orders as $order){
    if(isset($entertainerOrders[$order['id']])) {
        $entertainerOrder = $entertainerOrders[$order['id']];
    }
    if(isset($venueOrders[$order['id']])) {
        $venueOrder = $venueOrders[$order['id']];
    }
    ?>
    <div class="panel-group">
    <div class="panel panel-info">
        <div class="panel-heading">
            Order &numero;<?=$order['id'];?>
            <!-- <a style="color:#fff;text-decoration: none;cursor:pointer;">
            <span class="glyphicon glyphicon-menu-down pull-right panel-icon"></span>
            </a> -->
            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
        </div>
        <div class="panel-body">
            <div class="panel-group">
            <?php
            if(!empty($entertainerOrder)){
                ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Entertainer
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered pending-orders-table" cellspacing="0" cellpadding="0">
                                <tr class="info">
                                    <th class="small">
                                        Order &numero;
                                    </th>
                                    <th class="small">
                                        Party Type
                                    </th>
                                    <th class="small">
                                        Event Time
                                    </th>
                                    <th class="small">
                                        <span style="color:red;">
                                            <?=$order['status'];?>
                                        </span>
                                    </th>
                                </tr>
                                <tr style="background-color:#ffffcc !important;">
                                    <td class="small" style="width:10%;">
                                        <?=$order['id'];?>
                                    </td>
                                    <td class="small" style="width:30%;">
                                        <?=$partyTypesData[$entertainerOrder['party_type_id']].'('.$entertainerOrder['host_child_name'].')';?>
                                    </td>
                                    <td class="small" style="width:30%;">
                                        <?php 
                                        $startTimeObj = new DateTime($entertainerOrder['start_time']);
                                        $startTime = $startTimeObj->format('H:i');
                                        $endTimeObj = new DateTime($entertainerOrder['end_time']);
                                        $endTime = $endTimeObj->format('H:i');
                                        echo $startTime.'-'.$endTime;
                                        ?>
                                    </td>
                                    <td style="width:30%;">
                                        <?=Html::button('Ackowlegde', ['class' => 'btn btn-success pull-right','style'=>'background-color: #11da17;border-color: #11da17;font-size: 15px;margin-top: 10px;padding: 3px !important;']);?>
                                    </td>
                                </tr>
                                <tr class="info">
                                    <td class="small">
                                        Payment date
                                    </td>
                                    <td colspan="3">
                                        <?=$entertainerOrder['price'];?>
                                    </td>
                                </tr>
                                <tr style="background-color:#e8f9c2 !important;">
                                    <td class="small" style="width:10%" colspan="5">
                                        Entertainer name - Tom Smith
                                    </td>
                                </tr>
                                <tr class="info">
                                    <td colspan="5" class="small" style="width:10%">
                                        Special Requests
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
            
                <?php
            }?>
            </div>
        </div>
    
    <?php
    if(!empty($venueOrder)) {

    }
    ?>
    </div>
    <?php
}
?>