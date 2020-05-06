<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
    <?= $form->field($userModel, 'user_type_id')->dropDownList(ArrayHelper::map($userTypeData, 'id', 'name') + [0 => 'All'], ['prompt' => 'Select', 'class' => 'form-control'])->label(false); ?>
</div>
<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
    <?= $form->field($model, 'name')->textInput()->label(false) ?>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
</div>

<?php ActiveForm::end(); ?>
