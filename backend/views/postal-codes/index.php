<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostalCodesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Postal Codes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postal-codes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Postal Codes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'abbr',
            'name',
            'postal_code_direction_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
