<?php

use yii\helpers\Html;

$this->title = $model->first_name.' '.$model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'User Entertainers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<p>
    <?= Html::a('Add Entertainer User', ['create', 'user_id'=>$model->entertainer_id], ['class' => 'btn btn-success']) ?>
</p>
<div class="entertainer-staff-update">
    <h1><?= Html::encode($this->title); ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider
    ]) ?>
</div>
