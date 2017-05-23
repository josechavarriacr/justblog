<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Tag */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
<div class="col-lg-5">
	
	<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-1">
		<div class="tag-form">
			<?php $form = ActiveForm::begin(); ?>
			<div class="col-lg-8 col-lg-offset-10">			
				<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
</div>