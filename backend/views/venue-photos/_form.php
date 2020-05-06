<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

?>

<div class="venue-photos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'venue_id')->hiddenInput()->label(false); ?>

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
                'value' => function ($searchModel) {
                    if ($searchModel->photo) {
                        
                        $photoPath = Yii::getAlias('@root').'/common/uploads/' . $searchModel->venue_id . '/'.$searchModel->id.'/'. $searchModel->photo;
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
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['venue-photos/update', 'venue_id' => $model->venue_id, 'id'=>$model->id],[]);
                    }
                ],
            ],
        ],
    ]); ?>