<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MetatagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Metatags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metatag-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Metatag', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'url:url',
            // 'description',
            // 'keywords',
            'category',
            // 'icon',
            // 'image',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
