<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use frontend\models\Post;

$this->title = 'Posts';
Yii::$app->site->getIcon();
?>

<div class="post-index">
	<div class="container"><!-- div start container -->
		<div class="row"><!-- div start row -->

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

			<div class="col-md-9"><!-- col-md-9 start -->
				<hr>
				<div class="row">
					<div class="col-lg-9 col-lg-offset-1">
						<?php foreach ($models as $post): ?> 
							<div class="blog">
								<h3 class="heading">
									<?= Html::a($post['titulo'], [$post['url']], ['class' => 'profile-link']) ?>
									<?php $size = strlen($post['titulo']); $size = ($size > 40)? ($size + 25) : ($size + 0); ?>
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
												$date=strtotime("-1 Year");
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
											$date=strtotime("-1 Year");
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

							<div class="col-md-3"><!-- div col start -->
								<hr>
								<div class="list-group list-group"><!-- div list-group start -->
									<h4 class="heading">Categorías <i class="glyphicon glyphicon-folder-open"></i></h4>
									<?php $categories = Post::getCategories();?>
									<?php foreach ($categories as $cat): ?>

										<a href="<?= Url::to(['post/category/', 'category'=>$cat['url']])?>" class="list-group-item"> 
											<span style="font-size: 15px" class="badge progress-bar-danger"><?=$cat['count']?></span><?=$cat['name']?></a> 
										<?php endforeach; ?>
										<hr class="">	

										<h4 class="heading">Etiquetas <span class="glyphicon glyphicon-tags"></span></h4>
										<?php $tags = Post::getTags(); ?>

										<?php foreach (array_slice($tags, 0,5) as $tg): ?>
											<a href="<?= Url::to(['post/tag/', 'category'=>$tg['name']])?>" class="list-group-item">
												<span style="font-size: 15px" class="badge progress-bar-danger"><?=$tg['count']?> </span><?=$tg['name']?></a>				
											<?php endforeach; ?>

											<div id="categories" class="collapse">
												<?php foreach (array_slice($tags, 5) as $tg): ?>
													<a href="<?= Url::to(['post/tag/', 'category'=>$tg['name']])?>" class="list-group-item">
														<span style="font-size: 15px" class="badge progress-bar-danger"><?=$tg['count']?> </span><?=$tg['name']?></a>				
													<?php endforeach; ?>

												</div>

												<button class="btn btn-default btn-sm btn-block" data-toggle="collapse" data-target="#categories">More <span class="caret"></span></button>
												<hr class="">

												<h4 class="heading">Hecho en Costa Rica</h4>
												<div class="bandera costarica" title="Costa Rica"></div>
												<hr class="">


											</div><!-- div list-group end -->
										</div><!-- div col end -->
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
