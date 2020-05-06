<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entertainer\EntertainerOrders */

$this->title = 'Update Entertainer Orders: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Entertainer Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entertainer-orders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
