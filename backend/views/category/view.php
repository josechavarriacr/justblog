<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

        <div class="row">
            <div class="col-lg-5">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                    'id',
                    'name',
                    'description',
                    'url:url',
                    'img',
                    ],
                    ]) ?> 
                </div>
                <div class="col-xs-5 col-md-3">
                    <div class="thumbnail">
                        <p>img: </p>
                        <img class="img-responsive" src="<?=$model->img?>" alt="Cinque Terre">
                    </div>
                </div>
            </div>
        </div>
