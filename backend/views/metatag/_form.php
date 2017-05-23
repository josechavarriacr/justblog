<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="metatag-form">
	<div class="container">
		<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
		
		<div class="col-lg-8 col-lg-offset-9">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-lg btn-primary']) ?>
		</div>

		<div class="col-lg-5">
			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
		</div>

		<div class="col-lg-5">
			<?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'ico')->fileInput() ?>
			<?= $form->field($model, 'img')->fileInput() ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>
</div>
