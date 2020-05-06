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
            <?php foreach ($productItemsData as $productItem) { ?>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 party-products-item">
                    <div class="card">
                        <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">
                                <?= Html::a($productItem->name, ['product/page', 'id' => $productItem->id], ['class' => 'product-name', 'title' => 'View Product']); ?>
                            </h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="food-price"><?= $productItem->price ?> £</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</div>