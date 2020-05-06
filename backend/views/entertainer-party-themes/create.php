<?php

use yii\helpers\Html;

$this->title = 'Create Entertainer Party Themes';
$this->params['breadcrumbs'][] = ['label' => 'Entertainer Party Themes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entertainer-party-themes-create">
    <?= $this->render('_form', [
        'model' => $model,
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ]) ?>

</div>
