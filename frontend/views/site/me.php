
<?php if (!is_null($model)):?>
	<?php $this->title= $model->name;?>
	<code>Página generada en <?=Yii::$app->formatter->asDateTime(time(),'medium');?></code>
	<div class="row">
		<article class="blog">
			<div class="col-lg-7 col-lg-offset-2 col-md-10 col-md-offset-1">
				
				<div class="row">
					<div class="col-lg-5">
						<img src="<?=$model->image?>" class="img-circle">
					</div>

					<div class="col-lg-5 text-center">
						<h1 class="heading"><?=$model->name?></h1>
						<span class="label label-primary">Cloud Software Engineer</span>
					</div>
				</div><hr>

				<p><?=$model->description;?></p>

			</div>
		</article>
	</div><hr>
	
<?php endif; ?>


