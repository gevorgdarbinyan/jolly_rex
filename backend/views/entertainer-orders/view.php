<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\entertainer\EntertainerOrders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Entertainer Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="entertainer-orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'entertainer_id',
            'order_id',
            'party_type_id',
            'theme_service_id',
            'additional_service_id',
            'entertainer_package_id',
            'event_date',
            'start_time',
            'end_time',
            'entertainers_count',
            'special_requests:ntext',
            'price',
            'price_type',
            'host_child_age',
            'host_child_gender',
            'host_child_name',
            'telephone_number',
            'venue_address:ntext',
            'post_code',
            'city',
            'note:ntext',
            'entertainer_name',
            'message:ntext',
            'status',
            'customer_id',
            'info_status',
        ],
    ]) ?>

</div>
