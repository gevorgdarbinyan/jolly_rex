<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Entertainer */

$this->title = 'Create Entertainer';
$this->params['breadcrumbs'][] = ['label' => 'Entertainers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entertainer-create">
    <?= $this->render('_form', [
        'model' => $model,
        'userModel' => $userModel
    ]) ?>

</div>
