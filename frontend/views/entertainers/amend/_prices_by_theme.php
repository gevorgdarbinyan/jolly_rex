<?php
use yii\helpers\Html;
$entertainerServiceIDs = [];
$entertainerGuestCounts = [];
if(!empty($entertainerOrderThemePrices)) {
    $entertainerServiceIDs = array_map(function($item){
        return $item['entertainer_service_id'];
    }, $entertainerOrderThemePrices);
    $entertainerGuestCounts = array_map(function($item){
        return $item['extra_guest_count'];
    }, $entertainerOrderThemePrices);
}
$str = Html::beginTag('table', ['class'=>'table table-bordered table-striped']);
    $str .= Html::beginTag('tr');
        $str .= Html::beginTag('th',['style'=>'font-size:17px;']);
            $str .= 'Party Theme';
        $str .= Html::endTag('th');
        $str .= Html::beginTag('th',['style'=>'font-size:17px;']);
            $str .= 'Duration';
        $str .= Html::endTag('th');

        $str .= Html::beginTag('th',['style'=>'font-size:17px;']);
            $str .= 'Guests';
        $str .= Html::endTag('th');
        
        $str .= Html::beginTag('th',['style'=>'font-size:17px;']);
            $str .= 'Extra guests';
        $str .= Html::endTag('th');

        $str .= Html::beginTag('th',['style'=>'font-size:17px;']);
            $str .= 'Price';
        $str .= Html::endTag('th');
        $str .= Html::beginTag('th');
        $str .= Html::endTag('th');
    $str .= Html::endTag('tr');
    foreach ($entertainerPriceData as $priceData) {
        $check = (!empty($entertainerServiceIDs) && in_array($priceData['id'], $entertainerServiceIDs)) ? true : false;
        $key = array_search($priceData['id'], $entertainerServiceIDs);
        $extraGuestCount = ($key !== false ) ? $entertainerGuestCounts[$key] : '';

        $price = ($key !== false ) ? ($extraGuestCount * $priceData['base_extra_price'] + $priceData['price']) : $priceData['price'];
        $str .= Html::beginTag('tr');
            $str .= Html::beginTag('td',['style'=>'font-size:16px;']);
                $str .= $priceData['service_name'];
                $str .= Html::hiddenInput('price_setup_id[]', $priceData['id'], ['class' => 'theme-service-id-class']);
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td', ['style'=>'font-size:14px;']);
                $str .= $priceData['duration'];
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td', ['style'=>'font-size:14px;']);
                $str .= $priceData['count_of_guests'];
            $str .= Html::endTag('td');
            
            $str .= Html::beginTag('td', ['style'=>'font-size:14px;']);
                $str .= Html::textInput('',$extraGuestCount,['class'=>'form-control extra-guest-count','style'=>'width:34px;display:inline-block;']);
                $str .= Html::hiddenInput('',$priceData['base_extra_price'],['class'=>'base-extra-price-class']);
                $str .= Html::beginTag('span',['style'=>'display:inline-block;']);
                    $str .= 'X £'.$priceData['base_extra_price'].' per guest';
                $str .= Html::endTag('span');
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td', ['style'=>'font-size:14px;']);
                $str .= Html::beginTag('span',['class'=>'price-text']);
                    $str .= $price;
                $str .= Html::endTag('span');
                $str .= Html::hiddenInput('price',$price,['class'=>'price-class']);
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td');
                $str .= Html::checkbox('', $check, array('labelOptions' => ['style' => 'padding:5px;'], 'class' => 'theme-service-price-class', 'style'=>'width: 18px;height: 18px;'));
            $str .= Html::endTag('td');
        $str .= Html::endTag('tr');
    }
$str .= Html::endTag('table');

echo $str;