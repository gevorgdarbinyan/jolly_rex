<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                'data-pjax' => 1
            ],
            'fieldConfig' => [
                'options' => [
                    'tag' => false,
                ],
            ],
        ]);
?>


<?php
    $model->user_type_id = Yii::$app->request->get('UserSearch')['user_type_id'];
    $model->search_name = Yii::$app->request->get('UserSearch')['search_name'];
    
    $search = (Yii::$app->request->get('UserSearch')['user_type_id'] || Yii::$app->request->get('UserSearch')['search_name']);
?>
<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 input-group-search mb-3">
    <input type="hidden" class="search_type <?= ($search) ? ' search_mode' : '' ?>">
    <div class="input-group-prepend">
        <?=$form->field($model, 'user_type_id')->dropDownList(ArrayHelper::map($userTypeData, 'id', 'name')+[0=>'All'], ['prompt'=>'Select', 'class' => 'form-control input-group-text-addon'])->label(false); ?>
    </div>
        <?= $form->field($model, 'search_name', ['template' => '{input}', 'options' => ['tag' => false]])->textInput()->label(false); ?>
    <div class="form-group" style="margin-left: 10px;">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="form-group" style="margin-left: 10px;">
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>
</div>


<?php ActiveForm::end(); ?>
