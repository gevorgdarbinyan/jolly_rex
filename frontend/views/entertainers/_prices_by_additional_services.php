<?php
use yii\helpers\Html;
use common\models\PartyTheme;
use yii\helpers\ArrayHelper;
use common\models\entertainer\EntertainerServices;
$str = Html::beginTag('table', ['class'=>'table table-bordered table-striped']);
    $str .= Html::beginTag('tr');
        $str .= Html::beginTag('th',['style'=>'font-size:17px;']);
            $str .= 'Extras';
        $str .= Html::endTag('th');
        $str .= Html::beginTag('th',['style'=>'font-size:17px;']);
            $str .= 'Duration';
        $str .= Html::endTag('th');

        $str .= Html::beginTag('th',['style'=>'font-size:17px;']);
            $str .= 'Number of guests';
        $str .= Html::endTag('th');

        $str .= Html::beginTag('th',['style'=>'font-size:17px;']);
            $str .= 'Price (£)';
        $str .= Html::endTag('th');
        $str .= Html::beginTag('th');
        $str .= Html::endTag('th');
    $str .= Html::endTag('tr');
    foreach ($entertainerPriceData as $priceData) {
        $partyThemeData = PartyTheme::findOne($priceData['party_theme_id']);
        $durationData = EntertainerServices::getServiceDuration($priceData);
        $durationList = ArrayHelper::map($durationData,'duration','duration');
        $guestData = EntertainerServices::getServiceCountOfGuests($priceData);
        $guestList = ArrayHelper::map($guestData,'count_of_guests','count_of_guests');
        $check = false;
        $str .= Html::beginTag('tr');
            $str .= Html::beginTag('td',['style'=>'vertical-align: middle;font-size: 17px;']);
                $str .= $partyThemeData['name'];
                $str .= Html::hiddenInput('',$priceData['id'],['class'=>'additional-service-id-class']);
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td', ['style'=>'font-size:12px;']);
                $str .= Html::dropDownList('duration', '', $durationList, ['prompt' => 'Duration', 'class' => 'form-control additional-services-duration','prompt'=>'','style'=>'font-size: 17px;']);
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td', ['style'=>'font-size:12px;']);
                $str .= Html::dropDownList('','',$guestList,['class'=>'form-control additional-services-count-of-guests','prompt'=>'', 'style'=>'font-size: 17px;']);
            $str .= Html::endTag('td');
            $str .= Html::beginTag('td', ['style'=>'font-size:12px;']);
                $str .= Html::beginTag('span',['class'=>'price-text']);
                    $str .= '';
                $str .= Html::endTag('span');
            $str .= Html::endTag('td');

            $str .= Html::beginTag('td');
                $str .= Html::checkbox('', $check, array('labelOptions' => ['style' => 'padding:5px;'], 'class' => 'additional-services-price-class', 'style'=>'width: 18px;height: 18px;'));
            $str .= Html::endTag('td');
        $str .= Html::endTag('tr');
    }
$str .= Html::endTag('table');

echo $str;