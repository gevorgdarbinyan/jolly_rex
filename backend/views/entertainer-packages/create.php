<?php

use yii\helpers\Html;

$this->title = 'Create Entertainer Packages for '.$userData['name'];
$this->params['breadcrumbs'][] = ['label' => 'Entertainer Packages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entertainer-packages-create">

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider
    ]) ?>

</div>
