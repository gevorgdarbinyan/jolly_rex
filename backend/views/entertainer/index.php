<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EntertainerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entertainers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entertainer-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => 'Email',
                'attribute'=>'user_id',
                'value' => function($data) {
                    return ($data->user_relation) ? $data->user_relation->email : '';
                }
            ],
            'name',
            'first_name',
            'last_name',
            [
                'label' => 'Sopport Instant Booking',
                'attribute'=>'support_instant_booking',
                'value' => function($data) {
                    return ($data->support_instant_booking == 1) ? 'Yes' : 'No';
                }
            ],
            //'support_instant_booking',
            //'short_description:ntext',
            //'description:ntext',
            //'price_description:ntext',
            //'package_description:ntext',
            //'rating',
            //'first_line_address:ntext',
            //'phone_number',
            //'video:ntext',

            [
                'header' => Html::a('<span class="glyphicon glyphicon-plus"></span>', ['create'], ['class' => 'btn btn-success']),
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {staff} {price} {packages} {party-themes} {photo} {postal-codes}{branches}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, []);
                    },
                    'staff' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-user" title="Staff"></span>',['entertainer-staff/create', 'entertainer_id' => $model->id],[]);
                    },
                    'price' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-euro" title="Services"></span>',['entertainer-services/create', 'entertainer_id' => $model->id],[]);
                    },
                    'packages' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-folder-close" title="Packages"></span>',['entertainer-packages/create', 'entertainer_id' => $model->id],[]);
                    },
                    'party-themes' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-align-justify" title="Party Themes"></span>',['entertainer-party-themes/create', 'entertainer_id' => $model->id],[]);
                    },
                    'photo' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-picture" title="Photos"></span>',['entertainer-photos/create', 'entertainer_id' => $model->id],[]);
                    },
                    'postal-codes' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-tag" title="Postal codes"></span>',['entertainer-postal-codes/create', 'entertainer_id' => $model->id],[]);
                    },
                    'branches' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-tent" title="Branches"></span>',['entertainer-branches/create', 'entertainer_id' => $model->id],[]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
