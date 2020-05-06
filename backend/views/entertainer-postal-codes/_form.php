<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\PostalCodes;

/* @var $this yii\web\View */
/* @var $model common\models\EntertainerPostalCodes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entertainer-postal-codes-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'entertainer_id')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'postal_code_id')->dropDownList(ArrayHelper::map(PostalCodes::find()->orderBy('name')->all(),'id','name')); ?>
    <?= $form->field($model, 'creator_id')->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'postal_code_id',
                'filter'=>ArrayHelper::map(PostalCodes::find()->asArray()->all(), 'id', 'name'),
                'value' => function($data) {
                    return $data->postalCodes_relation->name;
                }
            ],
            [
                'attribute'=>'creator_id',
                'value' => function($data) {
                    return $data->user_relation->email;
                }
            ],
            'created_date',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['entertainer-postal-codes/update', 'entertainer_id' => $model->entertainer_id,'id'=>$model->id],[]);
                    }
                ],
            ],
        ],
    ]); ?>

</div>
