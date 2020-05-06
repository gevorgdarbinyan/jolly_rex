<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entertainers';

$this->registerCssFile("@web/css/entertainers/index.css");
//$orderID = $orderData->id;
?>
<div class="container" style="margin-top: 65px;">
    <?=$this->render('/orders/active-order-line',['order'=>$orderData]);?>
    <h1 class="entertainer-page-header"><?= $this->title ?></h1>


    <div class="row">
        <?=
        $this->render('_search_by_name', [
            'model' => $searchModel,
                //'userTypeData' => $userTypeData
        ])
        ?>
    </div>

    <div class="entertainer-data">
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="entertainer-page-search">
                <?= $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>

        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
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
                'itemView' => function ($model, $key, $index, $widget) {
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
</div>
