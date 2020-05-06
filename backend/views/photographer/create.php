<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Photographer */

$this->title = 'Create Photographer';
$this->params['breadcrumbs'][] = ['label' => 'Photographers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photographer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
