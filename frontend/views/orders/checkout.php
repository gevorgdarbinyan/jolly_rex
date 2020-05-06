<?php
use yii\helpers\Html;
use yii\web\View;
$this->registerJsFile('@web/js/orders/checkout.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="container" style="margin-top:50px;">
<form action="" method="POST">
   <div class="panel-group">
      <div class="panel panel-success">
        <div class="panel-heading">CHECKOUT</div>
        <div class="panel-body">
            <div class="well">
                <div class="row" style="padding:10px;">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Card number</label>
                            <?=Html::textInput('','',['placeholder'=>'Card Number...','class'=>'form-control','style'=>'height:45px;']);?>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <?=Html::dropdownList('','',['01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10','11','12'],['class'=>'form-control','style'=>'height:40px;'])?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <?=Html::dropdownList('','',['2018'=>'2018','2019'=>'2019','2020'=>'2020','2021'=>'2021',],['class'=>'form-control','style'=>'height:40px;'])?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <?=Html::textInput('','',['placeholder'=>'Security code...','class'=>'form-control','style'=>'height:40px;']);?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?=Html::textInput('','',['placeholder'=>'Name on Card...','class'=>'form-control','style'=>'height:45px;']);?>
                        </div>  
                        <div class="form-group text-right">
                            <button type="button" class="ellipsis btn btn-lg btn-danger complete-payment">Complete Payment</button>
                            <?=Html::hiddenInput('',$orderID, ['class'=>'order-id-class']);?>
                            <? //Html::a('Complete Payment', ['orders/confirmation'], ['class' => 'ellipsis btn btn-lg btn-danger']) ?>
                        </div>           
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</form>
</div>