<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use backend\models\Logs;
use miloschuman\highcharts\SeriesDataHelper;

$this->title = 'Charts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charts">
	<h1><?= Html::encode($this->title) ?></h1>

	<p>This is the Charts page. You may modify the following file to customize its content:</p>
	<p><code><?= __FILE__ ?></code></p>

	<p>
		<?= Highcharts::widget([
			'scripts' => [
			'modules/exporting',
			'themes/grid-light',
			],
			'options' => [
			'title' => [
			'text' => 'Popular Post',
			],
			'xAxis' => [
			'categories' => $name,
			],
			'series' => [
			[
			'type' => 'column',
			'name' => 'Visits',
			'data' => $visits,
			],
			],
			]
			]);?>

		<?= Highcharts::widget([
			'scripts' => [
			'modules/exporting',
			'themes/grid-light',
			],
			'options' => [
			'title' => [
			'text' => 'user analytics',
			],
			'labels' => [
			'items' => [
			[
			'style' => [
			'left' => '50px',
			'top' => '18px',
			'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
			],
			],
			],
			],
			'series' => [
			[
			'type' => 'pie',
			'name' => 'OS',
			'data' => $os,
			'center' => [600, 250],
			'size' => 150,
			'showInLegend' => false,
			],
			[
			'type' => 'pie',
			'name' => 'Device',
			'data' => $device,
			'center' => [400, 80],
			'size' => 150,
			'showInLegend' => false,
			],
			[
			'type' => 'pie',
			'name' => 'Type',
			'data' => $type,
			'center' => [200, 250],
			'size' => 150,
			'showInLegend' => false,
			],
			[
			'type' => 'pie',
			'name' => 'Browser',
			'data' => $browser,
			'center' => [900, 80],
			'size' => 170,
			'showInLegend' => false,
			],
			],
			]
			]);?>

		<?= Highcharts::widget([
			'scripts' => [
			'modules/exporting',
			'themes/grid-light',
			],
			'options' => [
			'title' => [
			'text' => 'user analytics',
			],
			'labels' => [
			'items' => [
			[
			'style' => [
			'left' => '50px',
			'top' => '18px',
			'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
			],
			],
			],
			],
			'series' => [
			[
			'type' => 'pie',
			'name' => 'Referrer',
			'data' => $referrer,
			'showInLegend' => false,
			],
			[
			'type' => 'pie',
			'name' => 'Language',
			'data' => $language,
			'center' => [950, 50],
			'size' => 100,
			'showInLegend' => false,
			],
			[
			'type' => 'pie',
			'name' => 'Visits',
			'data' => $new,
			'center' => [200, 250],
			'size' => 100,
			'showInLegend' => false,
			],
			],
			]
			]);?>
		</p>

	</div>
