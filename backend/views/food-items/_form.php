<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
?>

<div class="food-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'food_id')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'image')->fileInput(['type' => 'file']); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'label' => 'Food',
                'attribute' => 'food_id',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a($data->food_relation->name,'/food/view?id='.$data->food_id,[]);
                }
            ],
            'name',
            'price',
            [
                'attribute' => 'image',
                'label' => 'Image',
                'format' => ['image', ['width' => '100px', 'height' => '100px']],
                'value' => function ($searchModel) {
                    if ($searchModel->image) {
                        
                        $imagePath = Yii::getAlias('@root').'/common/uploads/food/' . $searchModel->food_id . '/'.$searchModel->id.'/'. $searchModel->image;
    //                        return Html::img($photoPath, ['width' => '100px', 'height' => '100px']);
    //                        return $imagePath;
                        return 'https://upload.wikimedia.org/wikipedia/commons/d/db/Patern_test.jpg';
                    } else {
                        return 1;
                    }
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete} {photo}',
                'buttons' => [
                    'update' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['food-items/update', 'food_id' => $model->food_id, 'id'=>$model->id],[]);
                    },
                    'photo' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-picture" title="Photos"></span>',['food-photos/create', 'food_id' => $model->id, 'id' => $model->id],[]);
                    }
                ],
            ],
        ],
    ]); ?>
