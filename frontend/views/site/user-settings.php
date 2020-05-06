<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'User Settings';
?>
<div id="site-user-settings">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <?php $form = ActiveForm::begin(['action' => ['site/user-settings'], 'id' => 'modify-form']); ?>

        <?= $form->field($userDataModel, 'first_name')->textInput(); ?>

        <?= $form->field($userDataModel, 'last_name')->textInput(); ?>

        <?= $form->field($userDataModel, 'postal_code')->textInput(); ?>
        
        <div class="form-group">
            <?= Html::submitButton('Modify', ['class' => 'btn btn-primary', 'name' => 'modify-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
