<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Venue */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Venues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venue-view">

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
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user_relation->email;
                }
            ],
            'name',
            [
                'attribute'=>'short_description',
                'value'=>function($data) {
                    return strip_tags($data->short_description);
                }
            ],
            [
                'attribute'=>'description',
                'value'=>function($data) {
                    return strip_tags($data->description);
                }
            ],
            'rating',
            'price',
            'postal_code',
        ],
    ]) ?>

</div>
