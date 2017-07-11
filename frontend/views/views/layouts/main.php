<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <?=Yii::$app->site->getIcon();?> 
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
	<?php $this->beginBody() ?>

	<div class="wrap">
		<?php
		NavBar::begin([
			'brandLabel' => '<img src="/backend/web/uploads/profile/ico.ico" class="ico" >',
			'brandUrl' => Yii::$app->homeUrl,
			'options' => [
			'class' => 'navbar-custom navbar-fixed-top',
			],
			]);
		$menuItems = [
		['label' => '<span class="glyphicon glyphicon-book"></span> Post', 'url' => ['/post/']],
		['label' => '<span class="glyphicon glyphicon-user"></span> Bio', 'url' => ['/me']],
		['label' => '<span class="fa fa-rss"></span> RSS', 'url' => ['/post/rss']],
		];
		if (Yii::$app->user->isGuest) {
            // $menuItems[] = ['label' => '<span class="glyphicon glyphicon-log-in"></span> Login', 'url' => ['/site/login']];
		} else {
			$menuItems[] = ['label' => '<span class="glyphicon glyphicon-user"></span> Signup', 'url' => ['/site/signup']];
			$menuItems[] = '<li>'
			. Html::beginForm(['/site/logout'], 'post')
			. Html::submitButton(
				'Logout (' . Yii::$app->user->identity->username . ')',
				['class' => 'btn btn-link logout']
				)
			. Html::endForm()
			. '</li>';
		}
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => $menuItems,
			'encodeLabels' => false,
			]);
		NavBar::end();
		?>

		<div class="container">
			<?= Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				]) ?>
				<?= Alert::widget() ?>
				<?= $content ?>
			</div>
		</div>

		<!-- start footer -->
		<?php $this->beginContent('@app/views/layouts/footer.php'); ?>
		<?php $this->endContent(); ?>
		<!-- end footer -->

		<?php $this->endBody() ?>
	</body>
	</html>
	<?php $this->endPage() ?>
