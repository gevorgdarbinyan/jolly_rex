<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//use Yii;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Product';
$this->registerJsFile('@web/js/product/page.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/css/product/page.css');
?>

<div class="container">
    <div class="product-external-page">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="text-align-center" style="margin-top: 30px; margin-bottom: 30px;">
                        <?php
                        $images = [
                            [
                                'image' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_b.jpg',
                                'small' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_b.jpg',
                                'medium' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_b.jpg'
                            ],
                            [
                                'image' => 'http://farm4.static.flickr.com/3712/9478186779_81c2e5f7ef_b.jpg',
                                'small' => 'http://farm4.static.flickr.com/3712/9478186779_81c2e5f7ef_b.jpg',
                                'medium' => 'http://farm4.static.flickr.com/3712/9478186779_81c2e5f7ef_b.jpg'
                            ],
                            [
                                'image' => 'http://farm4.static.flickr.com/3789/9476654149_b4545d2f25_b.jpg',
                                'small' => 'http://farm4.static.flickr.com/3789/9476654149_b4545d2f25_b.jpg',
                                'medium' => 'http://farm4.static.flickr.com/3789/9476654149_b4545d2f25_b.jpg'
                            ],
                        ];

                        echo \amilna\elevatezoom\ElevateZoom::widget([
                            'images' => $images,
                        ]);
                        ?>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#description">Description</a></li>
                        <li><a data-toggle="tab" href="#reviews">Reviews</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="description" class="tab-pane fade in active">
                            <p><?= str_replace("\n","<br />",$productItemData->description); ?></p>
                        </div>
                        <div id="reviews" class="tab-pane fade">
                            <p>There are no reviews</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <h2 class="food-page-header"><?= $productItemData->name ?></h2>
                <h6>Availability: <?=($productItemData->in_stock == 1) ? 'In Stock' : 'Out of Stock';?></h6>
                <h5 class="price-header">£<?= $productItemData->price ?></h5>
                <h6><?=$productItemData->product_relation->name;?></h6>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-top:30px;padding:18px;">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon input-number-decrement">-</span>
                        <input type="text" class="form-control bfh-number food-item-count" data-min="0" data-max="9999999" value="1">
                        <span class="input-group-addon input-number-increment">+</span>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo Html::button('Add to Basket', ['class' => 'btn btn-primary add-to-cart']);?>
                </div>
            </div>
        </div>
    </div>

</div>