<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-settings">
	<h1><?= Html::encode($this->title) ?></h1>

	<p>This is the Settings page. You may modify the following file to customize its content:</p>

	<p><code><?= __FILE__ ?></code></p>

	<p>
		<?= Html::a('<i class="glyphicon glyphicon-flash"></i> Flush cache', ['/settings/flush-cache'], [
			'class' => 'btn btn-primary',
			'data' => [
			'method' => 'post',
			],
			]) ?>
		</p>
		<p>
			<?= Html::a('<i class="glyphicon glyphicon-trash"></i> Clear assets', ['/settings/clear-assets'], [
				'class' => 'btn btn-primary',
				'data' => [
				'method' => 'post',
				],
				]) ?>
			</p>



		</div>
