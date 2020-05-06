<?php

namespace frontend\components\profile;

use yii\base\Widget;

class CustomerProfilePersonalDetailsWidget extends Widget {

    public $content;
    public $userData;

    public function init() {
        parent::init();

        $this->content = $this->drawProfilePersonalDetails();
    }

    public function run() {
        return $this->content;
    }
    
    public function drawProfilePersonalDetails() {
        return $this->render('/user/customer/customer-profile-personal-details', ['userData' => $this->userData]);
    }

}
