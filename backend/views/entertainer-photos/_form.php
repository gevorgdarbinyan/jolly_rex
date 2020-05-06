<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
?>

<div class="entertainer-photos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'entertainer_id')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'photo')->fileInput() ?>

    <?= $form->field($model, 'type')->dropdownList(['main'=>'Main','other'=>'Other']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
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
                'value' => function ($searchModel) {
                    if ($searchModel->photo) {
                        
                        $photoPath = Yii::getAlias('@root').'/common/uploads/' . $searchModel->entertainer_id . '/'.$searchModel->id.'/'. $searchModel->photo;
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
                    'update' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['entertainer-photos/update', 'entertainer_id' => $model->entertainer_id,'id'=>$model->id],[]);
                    }
                ],
            ],
        ],
    ]); ?>