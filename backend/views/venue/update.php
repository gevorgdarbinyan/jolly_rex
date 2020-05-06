<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Venue */

$this->title = 'Update Venue: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Venues', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="venue-update">
    <?= $this->render('_form', [
        'model' => $model,
        'userModel' => $userModel
    ]) ?>

</div>
