<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//use Yii;
use yii\helpers\Html;

$this->title = 'Catering';

//$this->registerJsFile('@web/js/food/catering.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/css/food/catering.css');
?>
<div class="container">
    <div class="food-catering">
        <h1 class="food-page-header">Food</h1>
        <div class="row">
            <?= $this->render('_food_items_template', ['foodItemsData' => $foodItemsData]) ?>
        </div>
    </div>
</div>