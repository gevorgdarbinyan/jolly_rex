<?php

namespace frontend\components;


use yii\base\Widget;

class SysAdminWidget extends Widget {

    public $content;
    public $userData;
    public $userTypeData;
    public $userSearchModel;
    public $dataProvider;
    
    public function init() {
        parent::init();
        $this->content = 'This is Sys Admin widget';
        
    }
    
    public function run(){
        return $this->content;
    }
    
}
