<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//use Yii;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Catering';

$this->registerJsFile('@web/js/food/catering.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/css/food/catering.css');
?>
<div class="container">
    <div class="food-catering">
        <h1 class="food-page-header">Food</h1>
        <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
            <label>
                <input type="checkbox" class="search_food_items_checkbox">
                Search among food items
            </label>
            <input type="text" class="form-control search_food_pattern" placeholder="Search" style="display: none;">
        </div>
        <div class="col-lg-9 col-md-9 col-xs-12 col-sm-12 food-provider-block">
            <?php foreach ($foodProvidersData as $foodProvider) { ?>
                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12 food-item">
                    <div class="card">
                        <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">
                                <?= Html::a($foodProvider->name, ['food/index', 'id' => $foodProvider->id], ['class' => 'food-name', 'title' => 'View Products']); ?>
                            </h4>
                            <h2>
                                <?php
                                $foodProviderRating = $foodProvider->rating;
                                for ($i = 0; $i < 5; $i++) {
                                    if ($i < $foodProviderRating) {
                                        ?>
                                        <span class="glyphicon glyphicon-star rating-stars-yellow"></span>
                                        <?php
                                    } else {
                                        ?>
                                        <span class="glyphicon glyphicon-star rating-stars-grey"></span>
                                        <?php
                                    }
                                }
                                ?>
                            </h2>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</div>