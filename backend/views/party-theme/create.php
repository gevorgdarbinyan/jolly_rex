<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PartyTheme */

$this->title = 'Create Party Theme';
$this->params['breadcrumbs'][] = ['label' => 'Party Themes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="party-theme-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
