<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Venue */

$this->title = 'Create Venue';
$this->params['breadcrumbs'][] = ['label' => 'Venues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venue-create">
    <?= $this->render('_form', [
        'model' => $model,
        'userModel' => $userModel
    ]) ?>
</div>
