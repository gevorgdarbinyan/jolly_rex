<?php

use yii\helpers\Html;

$this->title = 'Create Venue Options';
$this->params['breadcrumbs'][] = ['label' => 'Venue Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venue-options-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'userData' => $userData
    ]) ?>

</div>
