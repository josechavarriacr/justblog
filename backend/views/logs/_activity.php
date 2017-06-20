<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Activity Ip';
?>
<table class="table table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Ip</th>
			<th>Module</th>
			<th>Count</th>
			<th>Referrer</th>
			<th>Language</th>
			<th>Method</th>
			<th>Browser</th>
			<th>Device</th>
			<th>Type</th>
			<th>Port</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($array as $value): ?>
			<tr>
				<td><?=$value['id'] ?></td>
				<td><?=$value['ip'] ?></td>
				<td><?=$value['module'] ?></td>
				<td><?=$value['count'] ?></td>
				<td><?=$value['referrer'] ?></td>
				<td><?=$value['language'] ?></td>
				<td><?=$value['method'] ?></td>
				<td><?=$value['browser'] ?></td>
				<td><?=$value['device'] ?></td>
				<td><?=$value['type'] ?></td>
				<td><?=$value['port'] ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>