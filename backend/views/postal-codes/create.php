<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PostalCodes */

$this->title = 'Create Postal Codes';
$this->params['breadcrumbs'][] = ['label' => 'Postal Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postal-codes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
