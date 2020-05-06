<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PartyType;
use common\models\PartyTheme;
use common\models\Services;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

?>

<div class="entertainer-prices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'entertainer_id')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'service_id')->dropDownList(ArrayHelper::map(Services::find()->all(), 'id', 'name'), ['prompt'=>'Service...']); ?>

    <?= $form->field($model, 'duration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'count_of_guests')->textInput() ?>

    <?= $form->field($model, 'extra_guest_count')->textInput() ?>
    
    <?= $form->field($model, 'entertainers_count')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success save-prices']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<h3>Attention! Entertainers count depends on Extra Guest Count.</h3>
<h4>For instance</h4>
<em style="color:red;">
    <p>Extra Guest Count: 5 </p>
    <p>Entertainers count: 2 </p>
    <p>When extra guest count is being given greater from 5 in entertainer external page, 
    then entertainers count should be 2</p>
</em>
</h6>
<div class="table-responsive">
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute'=>'party_theme_rel_id',
                'format'=>'raw',
                'value' => function($searchModel){
                    return $searchModel->service_relation->name;
                }
            ],
            'duration',
            'count_of_guests',
            'extra_guest_count',
            'entertainers_count',
            'price',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['entertainer-services/update', 'entertainer_id' => $model->entertainer_id,'id'=>$model->id],[]);
                    }
                ],
            ],
        ],
    ]); ?>
    </div>

    <?php

function getLnt($zip){
    //$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&sensor=false&key=AIzaSyCG_nVwR78B0ZH_AIovqksOjANsEoTfmBQ";
    //$result_string = file_get_contents($url);
    $result_string = '{
        "results" : [
           {
              "address_components" : [
                 {
                    "long_name" : "W13 8HQ",
                    "short_name" : "W13 8HQ",
                    "types" : [ "postal_code" ]
                 },
                 {
                    "long_name" : "Egerton Gardens",
                    "short_name" : "Egerton Gardens",
                    "types" : [ "route" ]
                 },
                 {
                    "long_name" : "West Ealing",
                    "short_name" : "West Ealing",
                    "types" : [ "neighborhood", "political" ]
                 },
                 {
                    "long_name" : "London",
                    "short_name" : "London",
                    "types" : [ "postal_town" ]
                 },
                 {
                    "long_name" : "Greater London",
                    "short_name" : "Greater London",
                    "types" : [ "administrative_area_level_2", "political" ]
                 },
                 {
                    "long_name" : "England",
                    "short_name" : "England",
                    "types" : [ "administrative_area_level_1", "political" ]
                 },
                 {
                    "long_name" : "United Kingdom",
                    "short_name" : "GB",
                    "types" : [ "country", "political" ]
                 }
              ],
              "formatted_address" : "Egerton Gardens, West Ealing, London W13 8HQ, UK",
              "geometry" : {
                 "bounds" : {
                    "northeast" : {
                       "lat" : 51.5192494,
                       "lng" : -0.3166133
                    },
                    "southwest" : {
                       "lat" : 51.5186765,
                       "lng" : -0.3183733
                    }
                 },
                 "location" : {
                    "lat" : 51.5190132,
                    "lng" : -0.3179869
                 },
                 "location_type" : "APPROXIMATE",
                 "viewport" : {
                    "northeast" : {
                       "lat" : 51.5203119302915,
                       "lng" : -0.3161443197084979
                    },
                    "southwest" : {
                       "lat" : 51.5176139697085,
                       "lng" : -0.318842280291502
                    }
                 }
              },
              "place_id" : "ChIJ7a1LWXcSdkgRtLuJ1e_93pA",
              "types" : [ "postal_code" ]
           }
        ],
        "status" : "OK"
     }';
    //out($result_string);die;
    $result = json_decode($result_string, true);
    //out($result);
    $result1[]=$result['results'][0];
    $result2[]=$result1[0]['geometry'];
    $result3[]=$result2[0]['location'];
    return $result3[0];
}
    
function getDistance($zip1, $zip2, $unit){
    $first_lat = getLnt($zip1);
    $next_lat = getLnt($zip2);
    $lat1 = $first_lat['lat'];
    $lon1 = $first_lat['lng'];
    $lat2 = $next_lat['lat'];
    $lon2 = $next_lat['lng']; 
    $theta=$lon1-$lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +
    cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
    cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);
    
    if ($unit == "K"){
    return ($miles * 1.609344)." ".$unit;
    }
    else if ($unit =="N"){
    return ($miles * 0.8684)." ".$unit;
    }
    else{
    return $miles." ".$unit;
    }
}

    $distance = getDistance('W138HQ','W1W6SQ','K');

   //echo $distance;

