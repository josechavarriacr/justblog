<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\Post;

?>

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