<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\PartyTheme;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Services */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="services-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'party_theme_id')->dropdownList(ArrayHelper::map(PartyTheme::find()->all(),'id','name'),['prompt'=>'Party Theme...']) ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'base_extra_price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
