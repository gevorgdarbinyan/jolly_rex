<?php

use yii\helpers\Html;


$this->title = 'Update Product Photos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Photos', 'url' => ['index']];
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
