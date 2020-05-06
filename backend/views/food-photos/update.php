<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FoodPhotos */

$this->title = 'Update Food Photos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Food Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="venue-photos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider
    ]) ?>

</div>
