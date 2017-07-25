<?php

use yii\helpers\Html;
use frontend\models\Post;
use kartik\ipinfo\IpInfo;
use kartik\popover\PopoverX;
use kartik\social\Disqus;
use frontend\components\Analytics;

Yii::$app->meta->getMetaTags($model->id);
?>
<div class="post-view">
	<code>Página generada en <?=Yii::$app->formatter->asDateTime(time(),'medium');?></code>
	<p>Me visitas desde<?=IpInfo::widget([
		'flagWrapperOptions' => [
		'class' => 'btn btn-lg btn-default'
		],
		'popoverOptions' => [
		'placement' => PopoverX::ALIGN_BOTTOM_LEFT
		]
		]);?></p>

		<div class="row">
			<article class="blog">
				<!-- <?=Yii::$app->getRequest()->getUserIP()?> -->
				<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
					<?php if ($model->img): ?>
						<img src="<?=$model->img?>" class="img-rounded center-block">
					<?php endif ;?>

					<!-- start _github -->
					<?php echo $this->render('_github', [
						'repo' => $model->repo,
						]); ?>
						<!-- end _github -->

						<hr>

						<p>Redactado en <span class="label label-success"><?=Yii::$app->formatter->asDate($model->created_at);?></span></p>
						<h1 class="heading"><?=$model->title;?></h1>
						<p><?=$model->text?></p>

						<!-- start _share -->
						<?php echo $this->render('_share', [
							'url' => $model->url,
							]); ?>
							<!-- end _share -->

						</div>
					</article>
				</div><hr>

				<div class="row">
					<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
						<?=Disqus::widget(['settings'=>['shortname'=>'chavarria-cr']]);?> 
					</div>
				</div>

			</div>