<?php

use yii\helpers\Html;

$this->title = 'Create Venue Photos';
$this->params['breadcrumbs'][] = ['label' => 'Venue Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venue-photos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider
    ]) ?>

</div>
