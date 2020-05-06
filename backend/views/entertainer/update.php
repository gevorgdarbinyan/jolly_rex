<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Entertainer */

$this->title = 'Update Entertainer: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Entertainers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entertainer-update">
    <?= $this->render('_form', [
        'model' => $model,
        'userModel' => $userModel
    ]) ?>
</div>
