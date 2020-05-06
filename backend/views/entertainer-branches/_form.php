<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\entertainer\EntertainerBranches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entertainer-branches-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'entertainer_id')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'first_line_address')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'post_code')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'area')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'city')->textInput(['rows' => 6]) ?>
    <?= $form->field($model, 'note')->textarea(['rows' => 6])?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div class="entertainer-branches-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'entertainer_id',
            'first_line_address:ntext',
            'post_code',
            'area:ntext',
            'city:ntext',
            //'note',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['entertainer-branches/update', 'entertainer_id' => $model->entertainer_id,'id'=>$model->id],[]);
                    }
                ],
            ],
        ],
    ]); ?>
</div>
