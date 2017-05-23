<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="visit-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'module')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'referrer')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'new')->checkbox() ?>
    <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'method')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'browser')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'os')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'device')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'csrfToken')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'port')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'user_agent')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
