<?php 
use kartik\social\Disqus;

if (!is_null($model)):?>

<?php $this->title= $model->title;?>
<code>Página generada en <?=Yii::$app->formatter->asDateTime(time(),'medium');?></code>
<div class="row">
	<article class="blog">
		<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
			<p>Redactado en <span class="label label-success"><?=Yii::$app->formatter->asDate($model->created_at);?></span></p>
			<h1 class="heading"><?=$model->title;?></h1>
			<p><?=$model->text?></p>
		</div>
	</article>
</div><hr>

<div class="row">
	<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
		<?=Disqus::widget(['settings'=>['shortname'=>'chavarria-cr']]);?> 
	</div>
</div>

<?php endif; ?>
