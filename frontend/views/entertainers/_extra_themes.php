<?php
use yii\helpers\Html;

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
            $str .= 'Price (£)';
        $str .= Html::endTag('th');
        $str .= Html::beginTag('th');
        $str .= Html::endTag('th');
    $str .= Html::endTag('tr');
    foreach ($entertainerExtraThemeServices as $extraTheme) {
        $str .= Html::beginTag('tr');
            $str .= Html::beginTag('td',['style'=>'font-size:16px;']);
                $str .= $extraTheme['service_name'];
                $str .= Html::hiddenInput('price_setup_id[]', $extraTheme['id'], ['class' => 'extra-theme-service-id-class']);
                $str .= Html::hiddenInput('extra_guest_count[]', $extraTheme['extra_guest_count'], ['class' => 'extra-theme-extra-guest-count-class']);
                $str .= Html::hiddenInput('entertainers_count[]', $extraTheme['entertainers_count'], ['class' => 'extra-theme-entertainers-count-class']);
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td', ['style'=>'font-size:14px;']);
                $str .= $extraTheme['duration'];
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td', ['style'=>'font-size:14px;']);
                $str .= $extraTheme['count_of_guests'];
            $str .= Html::endTag('td');
            
            $str .= Html::beginTag('td', ['style'=>'font-size:14px;']);
                $str .= Html::textInput('','',['class'=>'form-control extra-theme-extra-guest-count','style'=>'width:40px;display:inline-block;']);
                $str .= Html::hiddenInput('',$extraTheme['base_extra_price'],['class'=>'extra-theme-base-extra-price-class']);
                $str .= Html::beginTag('span',['style'=>'display:inline-block;']);
                    $str .= '<span style="font-size:10px;">X</span> £'.$extraTheme['base_extra_price'].' per guest';
                $str .= Html::endTag('span');
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td', ['style'=>'font-size:14px;']);
                $str .= Html::beginTag('span',['class'=>'price-text']);
                    $str .= $extraTheme['price'];
                $str .= Html::endTag('span');
                $str .= Html::hiddenInput('price',$extraTheme['price'],['class'=>'price-class']);
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td');
                $str .= Html::checkbox('', '', array('labelOptions' => ['style' => 'padding:5px;'], 'class' => 'extra-service-price-class', 'style'=>'width: 18px;height: 18px;'));
            $str .= Html::endTag('td');
        $str .= Html::endTag('tr');
    }
$str .= Html::endTag('table');

echo $str;