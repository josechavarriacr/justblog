
<?php if (!is_null($model)):?>

	<?php $this->title= $model->title;?>
	<code>Page generated on <?=Yii::$app->formatter->asDateTime(time(),'medium');?></code>
	<div class="row">
		<article class="blog">
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<p><span class="label label-success"><?=Yii::$app->formatter->asDate($model->created_at);?></span></p>
				<h1 class="heading"><?=$model->title;?></h1>
				<p><?=$model->text?></p>
			</div>
		</article>
	</div><hr>
	
<?php endif; ?>


