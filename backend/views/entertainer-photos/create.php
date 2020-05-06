<?php

use yii\helpers\Html;

$this->title = 'Create Entertainer Photos';
$this->params['breadcrumbs'][] = ['label' => 'Entertainer Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entertainer-photos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider
    ]) ?>
</div>
