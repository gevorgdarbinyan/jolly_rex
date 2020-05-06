<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FoodPhotos */

$this->title = 'Create Food Photos';
$this->params['breadcrumbs'][] = ['label' => 'Food Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venue-photos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'foodID' => $foodID,
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider
    ]) ?>

</div>
