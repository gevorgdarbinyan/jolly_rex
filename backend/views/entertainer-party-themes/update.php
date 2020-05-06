<?php

use yii\helpers\Html;
$this->title = 'Update Entertainer Party Themes: ' . $model->partyTheme_relation->name .' party theme for '.$model->entertainer_relation->name;
?>
<div class="entertainer-party-themes-update">
    <?= $this->render('_form', [
        'model' => $model,
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ]) ?>

</div>
