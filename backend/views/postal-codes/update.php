<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PostalCodes */

$this->title = 'Update Postal Codes: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Postal Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="postal-codes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
