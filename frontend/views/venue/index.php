<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use common\models\entertainer\EntertainerOrders;

$this->title = 'Venues';

$this->registerCssFile("@web/css/venue/index.css");
//$orderID = $orderData->id;
?>

<div class="container" style="margin-top: 65px;">
    <?=$this->render('/orders/active-order-line',['order'=>$orderData]);?>
    <div>
        <h1 class="venue-page-header"><?= $this->title ?></h1>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?=
        ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => [
                'tag' => 'div',
                'class' => 'list-wrapper',
                'id' => 'list-wrapper',
            ],
//        'layout' => "{pager}\n{items}\n{summary}",
            'layout' => "{pager}\n{items}",
            'itemView' => function ($model, $key, $index, $widget){
                return $this->render('_list_item', ['model' => $model]);

            // or just do some echo
            // return $model->title . ' posted by ' . $model->author;
                },
            'itemOptions' => [
                'tag' => false,
            ],
            'pager' => [
                'firstPageLabel' => 'first',
                'lastPageLabel' => 'last',
                'nextPageLabel' => 'next',
                'prevPageLabel' => 'previous',
                'maxButtonCount' => 3,
            ],
        ]);
        ?>
    </div>
    
</div>
