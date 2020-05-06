<?php

use yii\helpers\Html;

$this->title = Html::encode('Add Entertainer Price');
$this->params['breadcrumbs'][] = ['label' => 'Entertainer Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entertainer-prices-create">
    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider
    ]) ?>
</div>
