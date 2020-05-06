<?php

namespace frontend\components\profile;

use yii\base\Widget;

class CustomerProfileMyOrdersWidget extends Widget {

    public $content;
    public $userData;

    public function init() {
        parent::init();

        $this->content = $this->drawProfileOrders();
    }

    public function run() {
        return $this->content;
    }
    
    public function drawProfileOrders() {
        return $this->render('/user/customer/customer-profile-my-orders', ['userData' => $this->userData]);
    }

}
