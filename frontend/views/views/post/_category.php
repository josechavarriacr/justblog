<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use frontend\models\Post;

$this->title = $modelCategory->name;
?>

<div class="post-index">
	<div class="container"><!-- div start container -->
		<div class="row" ><!-- div start row -->

			<div class="col-lg-5 col-lg-offset-2" ><!--start modelCategory information -->
				<h2 class="text-center category">
					<span class="glyphicon glyphicon-folder-close"></span>
					<?=$modelCategory->name?>
				</h2>
				<p class="text-center"><?=$modelCategory->description?></p>
			</div><!--end modelCategory information -->


			<div class="col-lg-5 col-lg-offset-2">
				<div class="input-group">
					<?php $form = ActiveForm::begin(['method' => 'post', 'action' => Url::to(['post/']) ]) ?>
					<?= $form->field($Dynamic, 'var')
					->widget(Select2::classname(), [
						'data' => $data,
						'size' => Select2::LARGE,
						'language' => 'es',
						'theme' => Select2::THEME_BOOTSTRAP,
						'options' => ['placeholder' => 'Buscar...',
						'onchange' =>'this.form.submit()'
						],
						'pluginOptions' => [
						'allowClear' => true,
						],
						])
					->label(false)
					; ?>
					<?php ActiveForm::end(); ?>
				</div> 
			</div>

			<!-- start _posts -->
			<?php echo $this->render('_posts', [
				'models' => $models,
				'pages' => $pages,
				]); ?>
				<!-- end _posts -->


				<<!-- start _sidebar -->
				<?php echo $this->render('_sidebar', [
					'models' => $models,
					]); ?>
					<!-- end _sidebar -->
					
				</div><!-- dic end row -->
			</div><!-- div end container -->
		</div>

		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
