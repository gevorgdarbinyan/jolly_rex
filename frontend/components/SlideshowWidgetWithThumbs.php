<?php
namespace frontend\components;

use yii\base\Widget;
use yii\helpers\Html;

class SlideshowWidgetWithThumbs extends Widget {
    
    public $slideshowContent;
    public $slideshowPhotos = [];


    public function init() {
        parent::init();
//        $this->slideshowContent = '';
//        $this->slideshowContent .= Html::beginTag('div', ['class' => 'row']);
//        $this->slideshowContent .= Html::beginTag('div', ['class' => 'col-lg-7 col-md-7 col-sm-12 col-xs-12']);
//        $this->slideshowContent .= $this->drawSlideshow();
//        $this->slideshowContent .= Html::endTag('div');
//        $this->slideshowContent .= Html::endTag('div');
        
        $this->slideshowContent = '                <div class="product-slider" style="margin-bottom: 20px;">
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
                </div>';
    }

    public function run(){
        return $this->slideshowContent;
    }
    
    public function drawSlideshow() {
        $str = '';
        
        $str .= Html::beginTag('div', ['class' => 'product-slider', 'style' => 'margin-bottom: 20px;']);
        
        $str .= $this->drawSliderImages();
        
        $str .= $this->drawThumbnails();
        
        $str .= Html::endTag('div');
        
        return $str;
    }
    
    public function drawSliderImages() {
        $str = '';
        
        if ($this->slideshowPhotos) {
            $str .= Html::beginTag('div', ['id' => 'carousel slide', 'data-ride' => 'carousel']);
            $str .= Html::beginTag('div', ['class' => 'carousel-inner']);
            
            $i = 0;
            foreach ($this->slideshowPhotos as $key => $sliderPhoto) {
                $activeClass = ($i == 0) ? 'item active' : 'item';
                $str .= Html::beginTag('div', ['class' => $activeClass]);
                $str .= Html::img('/images/slideshow/' . $sliderPhoto, []);
                $str .= Html::endTag('div');
                $i++;
            }
            
            $str .= Html::endTag('div');
            $str .= Html::endTag('div');
        }
        
        return $str;
        
    }
    
    public function drawThumbnails() {
        $str = '';
        
        $str .= Html::beginTag('div', ['class' => 'clearfix']);
        $str .= Html::beginTag('div', ['id' => 'thumbcarousel', 'class' => 'carousel slide', 'data-interval' => false]);
        
        $str .= Html::beginTag('div', ['class' => 'carousel-inner']);
        
        if ($this->slideshowPhotos) {
            
            $str .= Html::beginTag('div', ['class' => 'item active']);
            $i = 0;
            foreach ($this->slideshowPhotos as $key => $sliderPhoto) {
                $str .= Html::beginTag('div', ['data-target' => 'carousel', 'data-slide-to' => $i, 'class' => 'thumb']);
                $str .= Html::img('/images/slideshow/' . $sliderPhoto, []);
                $str .= Html::endTag('div');
            }
            $str .= Html::endTag('div');
        }
        
        $str .= '                            <a class="left carousel-new-style" href="#thumbcarousel" role="button" data-slide="prev">
                                <i class="glyphicon glyphicon-chevron-left" aria-hidden="true"></i>
                            </a>';
        
        $str .= '                                                        <a class="right carousel-new-style" href="#thumbcarousel" role="button" data-slide="next">
                                <i class="glyphicon glyphicon-chevron-right" aria-hidden="true"></i>
                            </a>';
        
        $str .= Html::endTag('div');
        
        $str .= Html::endTag('div');
        $str .= Html::endTag('div');
        
        return $str;
    }
    
}