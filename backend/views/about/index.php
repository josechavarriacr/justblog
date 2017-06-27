<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create About', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php if (!is_null($model)):?>
   <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Type</th>
                    <th>status</th>
                    <th>count</th>
                    <th>created_at</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($model as $var) : ?>
                    <tr>
                        <td>
                            <?= Html::a($var->id, [$var->id], ['class' => 'profile-link']) ?>
                        </td>
                        <td><?= $var->titulo ?></td>
                        <td><?= substr($var->descripcion, 0, 150 )?></td>
                        <td><?= $var->type?></td>
                        <td>
                            <?php if($var->status==1): ?>
                                <span class="label label-success">On</span>
                            <?php else: ?>
                                <span class="label label-default">Off</span>
                            <?php endif;?>
                        </td>
                        <td><?= $var->count ?></td>
                        <td><?= Yii::$app->formatter->asDatetime($var->created_at, 'php:Y-m-d H:i:s') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
      <?php endif; ?>
   </div>
