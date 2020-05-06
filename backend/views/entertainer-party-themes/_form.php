<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PartyTheme;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
?>

<div class="entertainer-party-themes-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'id')->textInput() ?> -->

    <?= $form->field($model, 'entertainer_id')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'party_theme_id')->dropdownList(ArrayHelper::map(PartyTheme::find()->all(),'id','name'),['prompt'=>'Party Theme...']) ?>

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
                'attribute'=>'party_theme_id',
                'filter'=>ArrayHelper::map(PartyTheme::find()->asArray()->all(), 'id', 'name'),
                'value' => function($data) {
                    return $data->partyTheme_relation->name;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['entertainer-party-themes/update', 'entertainer_id' => $model->entertainer_id,'id'=>$model->id],[]);
                    }
                ],
            ],
        ],
]); ?>
