<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchPartyTheme */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Party Themes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="party-theme-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Party Theme', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="table-responsive">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'name',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>
    <?php Pjax::end(); ?>
</div>
