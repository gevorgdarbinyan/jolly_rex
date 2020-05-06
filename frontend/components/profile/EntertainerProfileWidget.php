<?php

namespace frontend\components\profile;

use yii\base\Widget;

class EntertainerProfileWidget extends Widget {

    public $content;
    public $userData;

    public function init() {
        parent::init();

        $this->content = $this->drawProfile();
    }

    public function run() {
        return $this->content;
    }
    
    public function drawProfile() {
        return $this->render('/user/entertainer/entertainer-profile', ['userData' => $this->userData]);
    }

}
