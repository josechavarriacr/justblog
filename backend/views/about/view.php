<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Post;


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'About', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
?>

<div class="about-view">
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
				<?php if ($model->img): ?>
					<img src="<?=$model->img?>" class="img-rounded center-block">
				<?php endif ;?>
				<hr>
				<h1 class="heading"><?=$model->title;?></h1></br>
				<p><?=$model->text?></p>
			</div>
		</article>
	</div>

	