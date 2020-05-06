<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EntertainerPostalCodes */

$this->title = 'Create Entertainer Postal Codes';
$this->params['breadcrumbs'][] = ['label' => 'Entertainer Postal Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entertainer-postal-codes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ]) ?>

</div>
