<?php

use yii\helpers\Html;
use frontend\models\Post;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<div class="col-md-9"><!-- col-md-9 start -->
	<hr>
	<div class="row">
		<div class="col-lg-9 col-lg-offset-1">
			<?php foreach ($models as $post): ?> 
				<div class="blog">
					<h3 class="heading">
						<?= Html::a($post['title'], [$post['url']], ['class' => 'profile-link']) ?>
						<?php $size = strlen($post['title']); $size == ($size > 40)? ($size + 25) : ($size + 0); ?>
					</h3>
					<div class="row">
						<div class="col-lg-3">
							<p class="text-muted text-danger"><span class="fa fa-eye"> <?=$post['count']?> visitas </span></p>
						</div>
						<div class="col-lg-3-offset-0">
							<p class="text-muted">Posteado en <?=Yii::$app->formatter->asDate($post['created_at'])?></p>
						</div>
					</div>
					<?php $tags = Post::getTagsFront($post['id']);?>

					<?php if ($post['img']): ?>
						<div class="row">
							<div class="col-lg-7">
								<p class="text"><span class="label label-success"><?php 
									$date=strtotime("-3 week");
									if ($post['created_at'] > $date) {
										echo "nuevo";	
									} ;?></span> <?=substr($post['descripcion'], 0, 260 ) ?>.</p>
								</div>	

								<div class="col-lg-offset-5">
									<?=Html::a(Html::img($post['img'], ['class'=>'img-circle']), [$post['url']]) ?>
								</div>  
							</div>
						<?php else : ?> 
							<p class="text"><span class="label label-success"><?php 
								$date=strtotime("-3 week");
								if ($post['created_at'] > $date) {
									echo "nuevo";	
								} ;?></span> <?=substr($post['descripcion'], 0, 260 ) ?>.</p>
							<?php endif; ?> 

							<p><?php foreach($tags as $tag) : ?>
								<a href="<?= Url::to(['/post/tag/', 'category' => $tag]) ?>" 
									style="font-size: 16px" class="badge progress-bar-info">#<?=$tag?></a>
								<?php endforeach; ?></p>

							</div><hr>
						<?php endforeach; ?>
					</div>
				</div>
				<hr>

				<?=LinkPager::widget([
					'pagination' => $pages,
					]);?> 
							</div><!-- col-md-9 start -->