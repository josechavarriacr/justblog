<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
	<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
		<div class="category-form">
			<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

			<div class="col-lg-8 col-lg-offset-10">
				<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-lg btn-success' : 'btn btn-lg btn-primary']) ?>
			</div>

			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'description')->textArea(['maxlength' => 500,'rows' => '4']) ?>
			<?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
			<?php if ($model->img): ?>
				<div class="img-preview">
					<?= Html::img($model->img, ['width'=>'50','height'=>'50']) ?>
				</div>
			<?php endif; ?>
			<?= $form->field($model, 'file')->fileInput()?>
			<?php ActiveForm::end(); ?>

		</div>
	</div>
</div>