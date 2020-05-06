<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entertainer-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => [
                    'data-pjax' => 1
                ],
    ]);
    ?>
    <div class="form-group">
        <?= $form->field($model, 'price_range')->dropDownList(['0-150' => '£0 - £150', '151-250' => '£151 - £250', '251-500' => '£251 - £500', '501' => '> £501'], ['prompt' => 'Select price range']); ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
