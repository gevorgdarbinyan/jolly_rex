<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\entertainer\EntertainerBranches */

$this->title = 'Create Entertainer Branches';
$this->params['breadcrumbs'][] = ['label' => 'Entertainer Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entertainer-branches-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ]) ?>

</div>
