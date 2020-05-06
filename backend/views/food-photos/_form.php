<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\FoodPhotos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="food-photos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'food_item_id')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'photo')->fileInput() ?>

    <?= $form->field($model, 'type')->dropdownList(['main' => 'Main', 'other' => 'Other']) ?>

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
                'value' => function ($searchModel) use($foodID) {
                    if ($searchModel->photo) {
                        
                        $photoPath = Yii::getAlias('@root').'/common/uploads/' . $foodID . '/'.$searchModel->id.'/'. $searchModel->photo;
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
                    'update' => function($url, $model) use($foodID) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['food-photos/update', 'food_id' => $foodID, 'id'=>$model->id],[]);
                    }
                ],
            ],
        ],
    ]); ?>