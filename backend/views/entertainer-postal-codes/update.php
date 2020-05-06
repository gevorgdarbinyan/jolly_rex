<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EntertainerPostalCodes */

$this->title = 'Update Entertainer Postal Codes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Entertainer Postal Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entertainer-postal-codes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ]) ?>

</div>
