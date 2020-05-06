<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label'=>'Customer',
                'attribute'=>'customer_id',
                'value' => function($data) {
                    return ($data->customer_relation) ? $data->customer_relation->user_relation->email : '';
                }
            ],
            [
                'label'=>'Entertainer',
                'attribute'=>'entertainer_id',
                'value' => function($data) {
                    return ($data->entertainer_relation) ? $data->entertainer_relation->user_relation->email : '';
                }
            ],
            'status',
            'price',
            //'venue_id',
            //'food_id',
            //'product_id',
            //'creator_id',
            //'created_date',
            'order_type',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'header' => '',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {approve} {price} {packages} {party-themes} {photo} {postal-codes}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, []);
                    },
                    'approve' => function($url, $model){
                        return '<span class="glyphicon glyphicon-arrow-up" title="Fullfill" style="color:red;cursor:pointer;"></span>';
                    }
                ],
            ],
        ],
    ]); ?>
</div>
