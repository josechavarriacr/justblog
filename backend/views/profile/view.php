<?php

use yii\helpers\Html;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

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
            <article class="blog">
                <div class="col-lg-7 col-lg-offset-2 col-md-10 col-md-offset-1">

                    <div class="row">
                        <div class="col-lg-5">
                            <img src="<?=$model->image?>" class="img-circle">
                        </div>

                        <div class="col-lg-5 text-center">
                            <h1 class="heading"><?=$model->name?></h1>
                            <span class="label label-primary">Cloud Software Engineer</span>
                        </div>
                    </div><hr>

                    <div class="row">                   
                        <p><?=$model->description;?></p>
                    </div>

                </div>
            </article>
        </div><hr>

    </div>
