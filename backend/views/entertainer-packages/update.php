<?php

use yii\helpers\Html;

$this->title = 'Update Entertainer Packages: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Entertainer Packages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entertainer-packages-update">
    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>
</div>
