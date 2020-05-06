<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Entertainer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Entertainers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entertainer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Email',
                'attribute'=>'user_id',
                'value' => function($data) {
                    return $data->user_relation->email;
                }
            ],
            'name',
            'first_name',
            'last_name',
            'support_instant_booking',
            [
                'attribute'=>'short_description',
                'value'=>function($data) {
                    return strip_tags(html_entity_decode($data->short_description));
                }
            ],
            [
                'attribute'=>'description',
                'value'=>function($data) {
                    return strip_tags(html_entity_decode($data->description));
                }
            ],
            [
                'attribute'=>'price_description',
                'value'=>function($data) {
                    return strip_tags(html_entity_decode($data->price_description));
                }
            ],
            [
                'attribute'=>'package_description',
                'value'=>function($data) {
                    return strip_tags(html_entity_decode($data->package_description));
                }
            ],
            'rating',
            'first_line_address:ntext',
            'post_code',
            'area',
            'city',
            'phone_number',
            'video:ntext',
            'mileage_price'
        ],
    ]) ?>

</div>
