<?php
use common\models\Entertainer;
use yii\helpers\Html;
?>
<div>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="ourStaffBlockHeading">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" href="#customersGeoLocations" aria-expanded="false" aria-controls="customersGeoLocations">
                        Locations
                        <span class="glyphicon glyphicon-plus pull-right"></span>
                    </a>
                </h4>
            </div>
            <div id="customersGeoLocations" class="fade collapse">
                <div class="panel-body">
                    <h3 class="entertainer-page-titles">Areas where we work</h3>
                    <?php //out($geoLocations); ?>
                    <table class="table">
                            <tr>
                                <th>Area</th>
                                <th>Postal code</th>
                                <!-- <th>Direction</th> -->
                            </tr>
                        <?php foreach($geoLocations as $location) {?>
                            <tr>
                                <td><?=$location['postal_code_name']?></td>
                                <td><?=$location['postal_code_abbr']?></td>
                                <td><? //$location['postal_code_direction']?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>