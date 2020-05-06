<?php

namespace frontend\components;

use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\ListView;

class CustomerWidget extends Widget {

    public $content;
    public $userData;
    public $userTypeData;
    public $userSearchModel;
    public $dataProvider;

    public function init() {
        parent::init();

        $this->content = $this->drawSearchBlock();
        $this->content .= $this->drawSearchResultBlock();
    }

    public function run() {
        return $this->content;
    }

    public function drawSearchBlock() {
        $str = '';

        $str .= Html::beginTag('div', ['class' => 'homepage-search-block']);
        $str .= Html::beginTag('div', ['class' => 'row']);

        $str .= $this->render('/site/_search_by_name', [
            'model' => $this->userSearchModel,
            'userTypeData' => $this->userTypeData
        ]);

        $str .= Html::endTag('div');
        $str .= Html::endTag('div');

        return $str;
    }

    public function drawSearchResultBlock() {
        $str = '';

        $str .= Html::beginTag('div', ['class' => 'homepage-data-container']);
        
        $str .= ListView::widget([
                    'dataProvider' => $this->dataProvider,
//                    'options' => [
//                        'tag' => 'div',
//                        'class' => 'list-wrapper',
//                        'id' => 'list-wrapper',
//                    ],
                    'layout' => "{items}\n\n{pager}",
                    'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('/site/_list_item_homepage', ['model' => $model]);

            },
                    'itemOptions' => [
                        'tag' => false,
                    ],                    
        ]);
            
        $str .= Html::endTag('div');

        return $str;
    }

}
