<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\grid\GridView;
?>

<div class="product-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->hiddenInput()->label(false) ?>

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
                'label' => 'Product',
                'attribute' => 'product_id',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a($data->product_relation->name,'/product/view?id='.$data->product_id,[]);
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
                        
                        $imagePath = Yii::getAlias('@root').'/common/uploads/product/' . $searchModel->product_id . '/'.$searchModel->id.'/'. $searchModel->image;
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
                    'update' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['product-items/update', 'product_id' => $model->product_id, 'id' => $model->id], []);
                    },
                    'photo' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-picture" title="Photos"></span>',['product-photos/create', 'product_id' => $model->id, 'id' => $model->id], []);
                    }
                ],
            ],
        ],
]); ?>
