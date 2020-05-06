<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

?>

<div class="product-photos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_item_id')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'photo')->fileInput() ?>

    <?= $form->field($model, 'type')->dropdownList(['main'=>'Main','other'=>'Other']) ?>

    <div class="form-group">
        <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

  <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'photo',
                'label' => 'Photo',
                'format' => ['image', ['width' => '100px', 'height' => '100px']],
                'value' => function ($searchModel) use($productID) {
                    if ($searchModel->photo) {
                        
                        $photoPath = Yii::getAlias('@root').'/common/uploads/' . $productID . '/' . $searchModel->id . '/' . $searchModel->photo;
    //                        return Html::img($photoPath, ['width' => '100px', 'height' => '100px']);
    //                        return $photoPath;
                        return 'https://upload.wikimedia.org/wikipedia/commons/d/db/Patern_test.jpg';
                    } else {
                        return 1;
                    }
                }
            ],
            'type',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function($url, $model) use($productID) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['product-photos/update', 'product_id' => $productID, 'id' => $model->id], []);
                    }
                ],
            ],
        ],
    ]); ?>