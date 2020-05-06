<?php
namespace frontend\components;

use yii\base\Widget;
use yii\helpers\Html;

class SlideshowWidget extends Widget {
    
    public $slideshowContent;
    public $slideshowPhotos = [];


    public function init() {
        parent::init();
        $this->slideshowContent = '';
        $this->slideshowContent .= Html::beginTag('div', ['class' => 'row']);
        $this->slideshowContent .= Html::beginTag('div', ['class' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12']);
        $this->slideshowContent .= $this->drawSlideshow();
        $this->slideshowContent .= Html::endTag('div');
        $this->slideshowContent .= Html::endTag('div');
    }

    public function run(){
        return $this->slideshowContent;
    }
    
    public function drawSlideshow() {
        $str = '';
        
        $str .= Html::beginTag('div', ['id' => 'myCarousel', 'class' => 'carousel slide', 'data-ride' => 'carousel']);
        
        $str .= $this->drawIndicators();
        
        $str .= $this->drawSliderImages();
        
        $str .= $this->drawControlButtons();
        
        $str .= Html::endTag('div');
        
        return $str;
    }
    
    public function drawIndicators() {
        $str = '';
        if ($this->slideshowPhotos) {
            $str .= Html::beginTag('ol', ['class' => 'carousel-indicators']);
            $i = 0;
            foreach ($this->slideshowPhotos as $key => $sliderPhoto) {
                $activeClass = ($i == 0) ? 'active' : '';
                $str .= Html::beginTag('li', ['data-target' => '#myCarousel', 'data-slide-to' => $key, 'class' => $activeClass]);
                $str .= Html::endTag('li');
                $i++;
            }
            $str .= Html::endTag('ol');
        }
        
        return $str;
    }
    
    public function drawSliderImages() {
        $str = '';
        
        if ($this->slideshowPhotos) {
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
        }
        
        return $str;
        
    }
    
    public function drawControlButtons() {
        $str = '';
        
        if ($this->slideshowPhotos) {
            $leftIcon = '';
            $leftIcon .= Html::beginTag('span', ['class' => 'glyphicon glyphicon-chevron-left']);
            $leftIcon .= Html::endTag('span');
            $leftIcon .= Html::beginTag('span', ['class' => 'sr-only']);
            $leftIcon .= Html::encode('Previous');
            $leftIcon .= Html::endTag('span');
            
            $rightIcon = '';
            $rightIcon .= Html::beginTag('span', ['class' => 'glyphicon glyphicon-chevron-right']);
            $rightIcon .= Html::endTag('span');
            $rightIcon .= Html::beginTag('span', ['class' => 'sr-only']);
            $rightIcon .= Html::encode('Next');
            $rightIcon .= Html::endTag('span');
            
            $str .= Html::a($leftIcon, null, ['class' => 'left carousel-control', 'data-slide' => 'prev', 'href' => '#myCarousel']);
            $str .= Html::a($rightIcon, null, ['class' => 'right carousel-control', 'data-slide' => 'next', 'href' => '#myCarousel']);
            
        }
        
        return $str;
        
    }
    
}