<?php

use yii\helpers\Html;

$this->title = Html::encode('Update Entertainer Prices: ' . 
$model->service_relation->name.' '.$model->duration.' '.$model->price);
$this->params['breadcrumbs'][] = ['label' => 'Entertainer Custom Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<p>
    <?= Html::a('Add Custom Price', ['create', 'user_id'=>$model->entertainer_id], ['class' => 'btn btn-success']) ?>
</p>
<div class="entertainer-custom-update">

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider
    ]) ?>

</div>
