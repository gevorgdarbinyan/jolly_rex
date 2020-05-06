<?php

use yii\helpers\Html;

$this->title = 'Create Food Items';
$this->params['breadcrumbs'][] = ['label' => 'Food Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel'=> $searchModel,
        'dataProvider' => $dataProvider
    ]) ?>

</div>
