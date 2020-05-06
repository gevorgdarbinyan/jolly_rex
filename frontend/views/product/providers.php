<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//use Yii;
use yii\helpers\Html;

$this->title = 'Party Products';

//$this->registerJsFile('@web/js/product/party-products.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/css/product/party-products.css');
?>

<div class="container">

    <div class="party-products">
        <h1 class="party-products-page-header">Party Products</h1>
        <div class="row">
            <?php foreach ($productProvidersData as $productProvider) { ?>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 party-products-item">
                    <div class="card">
                        <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">
                                <?= Html::a($productProvider->name, ['product/index', 'id' => $productProvider->id], ['class' => 'product-name', 'title' => 'View Product']); ?>
                            </h4>
                            <h2>
                                <?php
                                $productProviderRating = $productProvider->rating;
                                for ($i = 0; $i < 5; $i++) {
                                    if ($i < $productProviderRating) {
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