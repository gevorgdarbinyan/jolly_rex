<?php
//use common\models\User;
//use yii\helpers\Html;
//use yii\web\View;
//use kartik\datetime\DateTimePicker;
//use \yii2fullcalendar\yii2fullcalendar;
//use kartik\time\TimePicker;
//use frontend\components\SlideshowWidget;
//use yii\helpers\ArrayHelper;
//use common\models\PartyType;

$this->registerCssFile("@web/css/venue/page.css");
//$this->registerJsFile('@web/js/venue/page.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
?>


<div class="container-fluid">
    <div class="venue-page">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="product-slider" style="margin-bottom: 20px;">
                    <div id="carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active"> <img src="/images/slideshow/1.jpg"> </div>
                            <div class="item"> <img src="/images/slideshow/2.jpg"> </div>
                            <div class="item"> <img src="/images/slideshow/3.jpg"> </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div id="thumbcarousel" class="carousel slide" data-interval="false">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div data-target="#carousel" data-slide-to="0" class="thumb"><img src="/images/slideshow/1.jpg"></div>
                                    <div data-target="#carousel" data-slide-to="1" class="thumb"><img src="/images/slideshow/2.jpg"></div>
                                    <div data-target="#carousel" data-slide-to="2" class="thumb"><img src="/images/slideshow/3.jpg"></div>
                                </div>
                            </div>
                            <!--<a class="left carousel-control carousel-left-control" href="#thumbcarousel" role="button" data-slide="prev">-->
                            <a class="left carousel-new-style" href="#thumbcarousel" role="button" data-slide="prev">
                                <i class="glyphicon glyphicon-chevron-left" aria-hidden="true"></i>
                            </a>
                            <!--<a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next">-->
                            <a class="right carousel-new-style" href="#thumbcarousel" role="button" data-slide="next">
                                <i class="glyphicon glyphicon-chevron-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div style="margin-bottom: 20px;">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true" aria-expanded="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="price-tab" data-toggle="tab" href="#price" role="tab" aria-controls="price" aria-selected="false">Price</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active in" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <div class="panel-body">
                                <?= $venueData['description'] ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="price" role="tabpanel" aria-labelledby="price-tab">
                            <div class="panel-body">
                            <?= $venueData['price'].' 1 hour'; ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="panel-body">
                                AAA
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

            </div>
        </div>
    </div>
</div>