<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Post;


/* @var $this yii\web\View */
/* @var $model backend\models\Post */

$this->title = 'Jose Chavarría';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="post-view">
	<p>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
			'confirm' => 'Are you sure you want to delete this item?',
			'method' => 'post',
			],
			]) ?>
		</p>
	</div>

	<div class="row">
		<article class="blog">
			<p><?=Yii::$app->formatter->asDate($model->created_at);?></p>
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<img src="<?=$model->img?>"
				class="img-rounded center-block" alt="Cinque Terre"><hr></br>
				<h1 class="heading"><?=$model->titulo;?></h1></br>
				<p><?=$model->text?></p>
			</div>
		</article>
	</div>

	<?php 
	$prev = Post::find()->where([ '<','id', $model->id])->orderBy(['id'=>SORT_DESC])->one();
	$next =Post::find()->where(['>','id', $model->id])->orderBy(['id'=>SORT_DESC])->one(); 
	?>

	<div class="row">
			<div class="col-xs-6 col-xs-offset-1 col-md-3">
				<?php if ($prev!=null): ?>
					<div class="thumbnail">
						<a href="<?= Html::encode($prev['url']) ?>">
							<img class="img-responsive" src="<?= Html::encode($prev['img']) ?>" alt="Cinque Terre">
						</a>
						<h3><?= Html::encode($prev['titulo']) ?></h3>
						<p><?= Html::encode(substr($prev['descripcion'],0,200)) ?></p>
						<div class="ratings">
							<p class="pull-right">15 reviews</p>
							<p>
								<span class="glyphicon glyphicon-star"></span>
								<span class="glyphicon glyphicon-star"></span>
								<span class="glyphicon glyphicon-star"></span>
								<span class="glyphicon glyphicon-star"></span>
								<span class="glyphicon glyphicon-star"></span>
							</p>
						</div>
					</div>
				<?php endif; ?> 
			</div>



			<div class="col-xs-6 col-xs-offset-4 col-md-3">
				<?php if ($next!=null): ?> 
					<div class="thumbnail">
						<a href="<?= Html::encode($next['url']) ?>">
							<img class="img-responsive" src="<?=Html::encode($next['img'])?>" alt="Cinque Terre">
						</a>
						<h3><?= Html::encode($next['titulo']) ?></h3>
						<p><?= Html::encode(substr($next['descripcion'], 0,200)) ?></p>
						<div class="ratings">
							<p class="pull-right">15 reviews</p>
							<p>
								<span class="glyphicon glyphicon-star"></span>
								<span class="glyphicon glyphicon-star"></span>
								<span class="glyphicon glyphicon-star"></span>
								<span class="glyphicon glyphicon-star"></span>
								<span class="glyphicon glyphicon-star"></span>
							</p>
						</div>
					</div>
				<?php endif ;?>
			</div>

	</div>
