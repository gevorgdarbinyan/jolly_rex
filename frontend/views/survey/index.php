<?php
use common\models\User;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\ArrayHelper;
use common\models\PartyType;
use common\models\PartyTheme;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\slider\Slider;
?>
<div class="container">
    <div class="survey-page">
        <h1>Survey</h1>
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <?= Html::dropDownList('Survey[part_type_id]','',ArrayHelper::map(PartyType::find()->all(), 'id', 'name'), ['prompt'=>'Party Type','class'=>'form-control']); ?>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <?= Html::dropDownList('Survey[part_theme_id]','',ArrayHelper::map(PartyTheme::find()->all(), 'id', 'name'), ['prompt'=>'Party Theme','class'=>'form-control']); ?>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                <?php
                        echo '<label>Start Date/Time</label>';
                        echo DateTimePicker::widget([
                            'name' => 'Survey[start_date]',
                            'options' => ['placeholder' => 'Select event start time ...'],
                            //'convertFormat' => true,
                            'pluginOptions' => [
                                //'format' => 'yyyy-mm-dd h:i',
                                'format' => 'yyyy-mm-dd HH:ii',
                                'autoclose' => true,
                                'startDate' => date('Y-m-d H:i'),
                                //'todayHighlight' => true
                            ]
                        ]);
                    ?>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                <?php
                    echo '<label>End Date/Time</label>';
                    echo DateTimePicker::widget([
                        'name' => 'Orders[end_date]',
                        'options' => ['placeholder' => 'Select event end time ...'],
                        //'convertFormat' => true,
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd HH:ii',
                            'autoclose'=> true,
                            'startDate' => date('Y-m-d H:i'),
                            //'todayHighlight' => true
                        ]
                    ]);
                    ?>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <?=Html::label('Number of children');?>
                    <?= Html::textInput('Survey[number_of_children]','', ['class'=>'form-control'])?>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                <?=Html::label('Price');?>
                <?php
                echo Slider::widget([
                    'name' => 'Survey[price]',
                    'sliderColor' => Slider::TYPE_PRIMARY,
                    'handleColor' => Slider::TYPE_PRIMARY,
                    'pluginOptions' => [
                        'orientation' => 'horizontal',
                        'handle' => 'square',
                        'min' => 10,
                        'max' => 300,
                        'step' => 1
                    ],
                ]);
                ?>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>