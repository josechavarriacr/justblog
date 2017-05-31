
<?php if (!is_null($model)):?>

	<?php $this->title= $model->name;?>
	<code>Página generada en <?=Yii::$app->formatter->asDateTime(time(),'medium');?></code>
	<div class="row">
		<article class="blog">
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<h1 class="heading"><?=$model->name;?></h1>
				<p><?=$model->description?></p>
			</div>
		</article>
	</div><hr>
	
<?php endif; ?>


