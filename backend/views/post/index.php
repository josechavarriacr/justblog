<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <p>
    <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
  </p>
  <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
    ['class' => 'yii\grid\SerialColumn'],

    'id',
    'title',
    'url:url',
        // 'img',
        // 'tags',
    [
    'attribute'      => 'created_at',
    'format'         => 'datetime',
    'contentOptions' => ['class' => 'hidden-xs'],
    'headerOptions'  => ['class' => 'hidden-xs'],
    ],
    [
    'label'=>'Status',
    'attribute'=>'status',
    'format'=>'raw',
    'value' => function( $model ){
      if($model->status)
        return '<span class="label label-success">On</span>';
      else
        return '<span class="label label-danger">Off</span>';
    }
    ],

    ['class' => 'yii\grid\ActionColumn',
    'template'=>'{view} {update} {delete}',
    'buttons'=>[
    'view' => function ($url, $model) {     
     return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'post/'.$model->url, ['title' => Yii::t('yii', 'View'),]);  
   }
   ],],
   ],
   ]); ?>
 </div>
