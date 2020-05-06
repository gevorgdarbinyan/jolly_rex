<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\VenueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Venues';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venue-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Venue', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'label' => 'Email',
                'attribute'=>'user_id',
                'value' => function($data) {
                    return $data->user_relation->email;
                }
            ],
            'name',
            /*[
                'attribute' => 'short_description',
                'value' => function($data) {
                    return strip_tags($data->short_description);
                }
            ],
            [
                'attribute' => 'description',
                'value' => function($data) {
                    return strip_tags($data->description);
                }
            ],*/
            //'rating',
            //'price',
            //'postal_code',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {options} {photo}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, []);
                    },
                    'options' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-cog"></span>',['venue-options/create', 'user_id' => $model->id],[]);
                    },
                    'photo' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-picture" title="Photos"></span>',['venue-photos/create', 'venue_id' => $model->id],[]);
                    }
                ],
            ],
        ],
    ]); ?>
</div>
