<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
?>

<div class="entertainer-staff-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo')->fileInput(['type' => 'file'])->label('Image'); ?>

    <div class="form-group">
        <?php
        echo '<label>Date</label>';
        echo DatePicker::widget([
            'name' => 'EntertainerStaff[date]', 
            'value' => $model->date,
            'options' => ['placeholder' => 'Date ...'],
            'pluginOptions' => [
                'format' => 'dd-M-yyyy',
                'todayHighlight' => true
            ]
        ]);?>
    </div>

    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <?php echo '<label>Time</label>';?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <?=TimePicker::widget([
                'name' => 'EntertainerStaff[start_time]',
                'value' => date('H:i'),
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                ],
                'options' => [
                    'class' => 'start-time'
                ],
            ]);?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <?=TimePicker::widget([
                'name' => 'EntertainerStaff[end_time]',
                'value' => date('H:i'),
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                ],
                'options' => [
                    'class' => 'end-time'
                ],
            ]);?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <?= $form->field($model, 'day')->dropDownList(['Monday' => 'Monday', 'Tuesday' => 'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday','Saturday'=>'Saturday','Sunday'=>'Sunday'], ['prompt' => 'Day...']); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <?= $form->field($model, 'entertainer_id')->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<div class="table-responsive">
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'first_name',
            'last_name',
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
            'entertainer_id',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['entertainer-staff/update', 'entertainer_id' => $model->entertainer_id,'id'=>$model->id],[]);
                    }
                ],
            ],
        ],
]); 
?>
</div>