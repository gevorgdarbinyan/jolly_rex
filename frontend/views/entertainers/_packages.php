<?php

use yii\helpers\Html;

$str = Html::beginTag('table',['class'=>'table table-bordered table-striped']);
$str .= Html::beginTag('tr');
    $str .= Html::beginTag('th');
        $str .= 'Package';
    $str .= Html::endTag('th');
    $str .= Html::beginTag('th');
        $str .= 'Price';
    $str .= Html::endTag('th');
    $str .= Html::beginTag('th');
    $str .= Html::endTag('th');
$str .= Html::endTag('tr');
foreach($entertainerPackageData as $packageData) {
    $check = ($orderModel && $packageData['id'] === $orderModel->entertainer_package_id) ? true : false;
    $str .= Html::beginTag('tr');
        $str .= Html::beginTag('td');
            $str.= $packageData['name'];
        $str .= Html::endTag('td');
        $str .= Html::beginTag('td');
            $str.= $packageData['price'];
        $str .= Html::endTag('td');
        $str .= Html::beginTag('td');
            $str .= Html::checkbox('',$check, array('labelOptions' => ['style' => 'padding:5px;'],'rel'=>$packageData['id'],'class' => 'package-price-class', 'style'=>'width: 18px;height: 18px;'));
        $str .= Html::endTag('td');
    $str .= Html::endTag('tr');
}
$str .= Html::beginTag('tr');
    $str .= Html::beginTag('td', ['colspan'=>3]);
        $str .= Html::beginTag('div', ['class'=>'pull-right']);
            $str .= Html::beginTag('strong');
                $str .= 'Total: ';
                $str .= Html::beginTag('span', ['class'=>'total-price']);
                    $str .= ($orderModel) ? $orderModel->price : '';
                $str .= Html::endTag('span');
            $str .= Html::endTag('strong');
            $str .= ($orderModel) ? Html::hiddenInput('Orders[price]',$orderModel->price,['class'=>'total-price-value']) : '';
            $entertainerPackageID = (!empty($orderModel->entertainer_package_id)) ? $orderModel->entertainer_package_id : '';
            $str .=  Html::hiddenInput('Orders[entertainer_package_id]',$entertainerPackageID,['class'=>'entertainer-package-class']);
    $str .= Html::endTag('div'); 
    $str .= Html::endTag('td');
$str .= Html::endTag('tr');
$str .= Html::endTag('table');

echo $str;