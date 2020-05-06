<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FoodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Foods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Food', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute'=>'description',
                'value' => function($data) {
                    return strip_tags($data->description);
                }
            ],
            [
                'attribute' => 'delivery',
                'value' => function($data) {
                    return ($data->delivery == 1) ? 'Yes' : 'No';
                }
            ],
            //'rating',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {items}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, []);
                    },
                    'items' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-th-list"></span>',['food-items/create', 'food_id' => $model->id],[]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
