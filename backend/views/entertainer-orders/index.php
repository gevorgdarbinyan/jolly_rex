<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\PartyType;
use yii\web\View;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel common\models\entertainer\EntertainerOrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entertainer Orders';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/js/entertainer-orders/index.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="entertainer-orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Entertainer Orders', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'header' => Html::a('<span class="glyphicon glyphicon-plus"></span>', ['create'], ['class' => 'btn btn-success']),
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete} {change-status} {notifications}',
                    'buttons' => [
                        'view' => function($url, $model) {
                            return '<span class="glyphicon glyphicon-eye-open view-details" style="cursor:pointer;"></span>';
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, []);
                        },
                        'change-status' => function($url, $model){
                            return '<span class="glyphicon glyphicon-stats change-status-class" title="Change status" style="cursor:pointer;" data-entertainer-order-id="'.$model->id.'"></span>';
                        },
                        'notifications' => function($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-envelope"></span>', $url, []);
                        }
                    ],
                ],
                'id',
                'order_id',
                'entertainer_id',
                [
                    'attribute'=>'party_type_id',
                    'filter'=>ArrayHelper::map(PartyType::find()->asArray()->all(), 'id', 'name'),
                    'value' => function($data) {
                        return $data->partType_relation->name;
                    }
                ],
                //'theme_service_id',
                //'additional_service_id',
                //'entertainer_package_id',
                [
                    'attribute' => 'event_date',
                    'value' => function($data) {
                        $date = new \DateTime($data->event_date);
                        $day = $date->format('l, F d, Y');
                        return $day;
                    }
                ],
                [
                    'attribute' => 'start_time',
                    'value' => function($data) {
                        $startTimeObj = new \DateTime($data->start_time);
                        $startTime = $startTimeObj->format('H:i');
                        return $startTime;
                    }
                ],
                [
                    'attribute' => 'end_time',
                    'value' => function($data) {
                        $endTimeObj = new \DateTime($data->end_time);
                        $endTime = $endTimeObj->format('H:i');
                        return $endTime;
                    }
                ],
                'entertainers_count',
                //'special_requests:ntext',
                'price',
                //'price_type',
                //'host_child_age',
                //'host_child_gender',
                'host_child_name',
                //'telephone_number',
                //'venue_address:ntext',
                //'post_code',
                //'city',
                //'note:ntext',
                //'entertainer_name',
                //'message:ntext',
                'status',
                'customer_id',
                'info_status',
            ],
        ]); ?>
    </div>
</div>


<?php
Modal::begin([
    'id' => 'entertainer-order-details-modal',
    'size' => 'modal-md',
    'header' => '<h3>Order Details</h3>'
]);?>
<div id="entertainer-order-details-modal-content">

            
</div>
<?php Modal::end();?>

<?php
Modal::begin([
    'id' => 'entertainer-order-status-change-modal',
    'size' => 'modal-md',
    'header' => '<h3>Order Status</h3>'
]);?>
<div id="entertainer-order-status-change-content">
    <div class="form-group">
        <?=Html::dropdownList('','',['FulFill'=>'FulFill','Cancell'=>'Cancell'],['prompt'=>'Status','class'=>'form-control status-class']);?>
        <?=Html::hiddenInput('','',['class'=>'entertainer-order-id-class']);?>
    </div>
    <div class="buttons">
        <button class="btn btn-success approve-status-change-class">Approve</button>
    </div>
</div>
<?php Modal::end();?>