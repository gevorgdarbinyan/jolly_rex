<?php

use yii\helpers\Html;

$this->title = 'Update Venue Options: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Venue Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="venue-options-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'userData' => $userData
    ]) ?>

</div>
