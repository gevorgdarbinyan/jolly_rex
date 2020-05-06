<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//use Yii;
use yii\helpers\Html;
?>
<?php foreach ($foodItemsData as $foodItem) { ?>
    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12 food-item">
        <div class="card">
            <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title">
                    <?= Html::a($foodItem->name, ['food/page', 'id' => $foodItem->id], ['class' => 'food-name', 'title' => 'View Product']); ?>
                </h4>
                <div class="row">
                    <div class="col-lg-12">
                        <p class="food-price"><?= $foodItem->price ?> £</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>