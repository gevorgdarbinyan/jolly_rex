<?php

use yii\helpers\Html;


$this->title =  'Add User Entertainers for '.$userData['name'];
$this->params['breadcrumbs'][] = ['label' => 'User Entertainers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entertainer-staff-create">
    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'userData' => $userData
    ]) ?>
</div>
