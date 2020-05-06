<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EntertainerPostalCodesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entertainer Postal Codes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entertainer-postal-codes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Entertainer Postal Codes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'entertainer_id',
            'postal_code_id',
            'creator_id',
            'created_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
