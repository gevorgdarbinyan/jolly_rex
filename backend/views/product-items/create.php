<?php

use yii\helpers\Html;


$this->title = 'Create Product Items';
$this->params['breadcrumbs'][] = ['label' => 'Product Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
