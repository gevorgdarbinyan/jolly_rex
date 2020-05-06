<?php
use yii\helpers\Html;

$str = Html::beginTag('table', ['class'=>'table table-bordered table-striped']);
    $str .= Html::beginTag('tr');
        $str .= Html::beginTag('th',['style'=>'font-size:17px;']);
            $str .= 'Party Theme';
        $str .= Html::endTag('th');

        $str .= Html::beginTag('th',['style'=>'font-size:17px;']);
            $str .= 'Guests';
        $str .= Html::endTag('th');
        
        $str .= Html::beginTag('th',['style'=>'font-size:17px;']);
            $str .= 'Price (£)';
        $str .= Html::endTag('th');
        $str .= Html::beginTag('th');
        $str .= Html::endTag('th');
    $str .= Html::endTag('tr');
    foreach ($entertainerAdditionalProductsServices as $additionalProducts) {
        $str .= Html::beginTag('tr');
            $str .= Html::beginTag('td',['style'=>'font-size:16px;']);
                $str .= Html::hiddenInput('price_setup_id[]', $additionalProducts['id'], ['class' => 'additional-products-service-id-class']);
                $str .= $additionalProducts['service_name'];
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td', ['style'=>'font-size:14px;']);
                $str .= $additionalProducts['count_of_guests'];
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td', ['style'=>'font-size:14px;']);
                $str .= Html::beginTag('span',['class'=>'price-text']);
                    $str .= $additionalProducts['price'];
                $str .= Html::endTag('span');
                $str .= Html::hiddenInput('price','',['class'=>'price-class']);
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td');
                $str .= Html::checkbox('', '', array('labelOptions' => ['style' => 'padding:5px;'], 'class' => 'additional-products-price-class', 'style'=>'width: 18px;height: 18px;'));
            $str .= Html::endTag('td');
        $str .= Html::endTag('tr');
    }
$str .= Html::endTag('table');

echo $str;