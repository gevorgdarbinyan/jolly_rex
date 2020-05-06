<?php
use yii\helpers\Html;
use yii\helpers\Json;

$str = Html::beginTag('table', ['class'=>'table table-bordered table-striped']);
    $str .= Html::beginTag('tr');
        $str .= Html::beginTag('th',['style'=>'font-size:12px;']);
            $str .= 'Party Theme';
        $str .= Html::endTag('th');
        $str .= Html::beginTag('th',['style'=>'font-size:12px;']);
            $str .= 'Duration';
        $str .= Html::endTag('th');

        $str .= Html::beginTag('th',['style'=>'font-size:12px;']);
            $str .= 'Count of guests';
        $str .= Html::endTag('th');

        $str .= Html::beginTag('th',['style'=>'font-size:12px;']);
            $str .= 'Price';
        $str .= Html::endTag('th');
        $str .= Html::beginTag('th');
        $str .= Html::endTag('th');
    $str .= Html::endTag('tr');
    foreach ($entertainerPriceData as $priceData) {
        $check = (!empty($entertainerOrderPriceList) && in_array($priceData['id'], $entertainerOrderPriceList)) ? true : false;
        $str .= Html::beginTag('tr');
            $str .= Html::beginTag('td',['style'=>'font-size:12px;']);
                $str .= Html::hiddenInput('', $priceData->id, ['class' => 'price-setup-id-class']);
                // $priceData->service_relation->partyTheme_relation->name; 
                $str .= $priceData->service_relation->name;
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td', ['style'=>'font-size:12px;']);
                $str .= $priceData->duration;
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td', ['style'=>'font-size:12px;']);
                $str .= $priceData->count_of_guests;
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td', ['style'=>'font-size:12px;']);
                $str .= $priceData->price;
            $str .= Html::endTag('td');
            // $priceData->service_relation->entertainers_number;
            $str .= Html::beginTag('td');
                $str.= Html::hiddenInput('', $priceData->service_relation->partyTheme_relation->id, ['class' => 'party-theme-id-class']);
                $str .= Html::checkbox('', $check, array('labelOptions' => ['style' => 'padding:5px;'], 'class' => 'add-price-class', 'style'=>'width: 18px;height: 18px;'));
            $str .= Html::endTag('td');
        $str .= Html::endTag('tr');
    }
    $str .= Html::beginTag('tr');
        $str .= Html::beginTag('td',['colspan'=>6]);
            $str .= Html::beginTag('div', ['class'=>'pull-right']);
                $str .= Html::beginTag('strong');
                    $str .= 'Total: ';
                    $str .= Html::beginTag('span', ['class'=>'total-price']);
                        $str .= ($orderModel) ? $orderModel['price'] : '';
                    $str .= Html::endTag('span');
                $str .= Html::endTag('strong');
                $str .= ($orderModel) ? Html::hiddenInput('Orders[price]',$orderModel['price'],['class'=>'total-price-value']) : '';
                $priceSetups = (!empty($entertainerOrderPriceList)) ? Json::encode($entertainerOrderPriceList) : '';
                $str .=  Html::hiddenInput('Orders[price_setups]',$priceSetups,['class'=>'price-setups']);
            $str .= Html::endTag('div');
        $str .= Html::endTag('td');
    $str .= Html::endTag('tr');
$str .= Html::endTag('table');

echo $str;