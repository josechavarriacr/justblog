<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\models\Logs;
use kartik\icons\Icon;
Icon::map($this);
?>

<div class="row">
	<div class="col-lg-5">
	<h1>Top Visitors by IP</h1>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Ip</th>
					<th>Country</th>
					<th>Flag</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($ips as $log) : ?>
					<tr>
						<td><?= $log['ip'] ?></td>
						<td><?= Logs::getCountry($log['ip']) ?></td>
						<td><?= Icon::show(Logs::getFlag($log['ip']),  ['class'=>'fa-2x'], Icon::FI) ?></td>
						<td><?= $log['total'] ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>