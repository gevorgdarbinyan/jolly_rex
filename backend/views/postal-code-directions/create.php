<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PostalCodeDirections */

$this->title = 'Create Postal Code Directions';
$this->params['breadcrumbs'][] = ['label' => 'Postal Code Directions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postal-code-directions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
