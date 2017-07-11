<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <div class="post-form">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <div class="col-lg-8 col-lg-offset-10">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-lg btn-success' : 'btn btn-lg btn-primary']) ?>
            </div>
            
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'descripcion')->textArea(['maxlength' => 500,'rows' => '4']) ?>
            <?= $form->field($model, 'file')->fileInput()?>


            <?= $form->field($model, 'text')->widget(\yii\redactor\widgets\Redactor::className(), [
                'clientOptions' => [
                'minHeight' => 400,
                'imageManagerJson' => ['/redactor/upload/image-json'],
                'imageUpload' => ['/redactor/upload/image'],
        // 'imageUpload' => \yii\helpers\Url::to(['/redactor/upload/image']),
                'fileUpload' => ['/redactor/upload/file'],
        // 'lang' => 'en_en',
                'plugins' => ['clips','imagemanager','table', 'video','fontfamily', 'fontsize','fontcolor'],
                ]
                ])?>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
