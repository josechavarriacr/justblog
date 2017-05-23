<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Visits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <!--  <p>
        <?= Html::a('Create Visit', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
    <!-- <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'ip',
            'module',
            'referrer',
            'new:boolean',
            'language',
            'method',
            'browser',
            'os',
            'device',
            'type',
            // 'csrfToken',
            'port',
            // 'user_agent',
            'time:datetime',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}'],
        ],
        ]); ?> -->

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ip</th>
                    <th>Module</th>
                    <th>Referrer</th>
                    <th>New</th>
                    <th>Lang</th>
                    <th>Method</th>
                    <th>Browser</th>
                    <th>Os</th>
                    <th>Device</th>
                    <th>Type</th>
                    <th>Port</th>
                    <th>Time</th>
                    <!-- <th>User_Agent</th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach($model as $log) : ?>
                    <tr>
                        <td>
                            <?= Html::a($log->id, [$log->id], ['class' => 'profile-link']) ?>
                        </td>

                        <td><?= $log->ip ?></td>
                        <td>
                            <?= Html::a($log->module, [$log->module], ['class' => 'profile-link']) ?>
                        </td>
                        <td>
                            <?= Html::a($log->referrer, $log->referrer, ['class' => 'profile-link']) ?>
                        </td>
                        <td>
                            <?php if($log->new): ?>
                                <span class="label label-success">New</span>
                            <?php else: ?>
                                <span class="label label-default">Back</span>
                            <?php endif;?>
                        </td>
                        <td><?= $log->language ?></td>
                        <td><?= $log->method ?></td>
                        <td  width="90px"><?= $log->browser ?></td>
                        <td><?= $log->os ?></td>
                        <td><?= $log->device ?></td>
                        <td>
                            <?php switch($log->type): 
                            case 'mobile': ?>
                            <span style="font-size: 15px" class="badge progress-bar-danger"><?=$log->type?></span>
                            <?php break;?>
                            <?php case 'tablet': ?>
                            <span style="font-size: 15px" class="badge progress-bar-success"><?=$log->type?></span>
                            <?php break;?>
                            <?php case 'desktop': ?>
                            <span style="font-size: 15px" class="badge progress-bar-info"><?=$log->type?></span>
                            <?php break;?>
                            <?php endswitch; ?>
                        </td>
                        <td><?= $log->port ?></td>
                        <td><?= Yii::$app->formatter->asDatetime($log->time, 'php:Y-m-d H:i:s') ?></td>
                        <!-- <td><?= $log->user_agent ?></td> -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?=LinkPager::widget([
            'pagination' => $pages,
            ]);?>
        </div>
