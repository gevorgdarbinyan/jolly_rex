<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PostalCodeDirections */

$this->title = 'Update Postal Code Directions: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Postal Code Directions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="postal-code-directions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
