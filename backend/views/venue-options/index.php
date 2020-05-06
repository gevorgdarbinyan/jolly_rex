<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Venue Options';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venue-options-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Venue Options', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'price',
            'description:ntext',
            'hour',
            //'venue_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
