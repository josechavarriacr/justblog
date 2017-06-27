<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
-->
<?php foreach($model as $value) : ?>
    <div class="row">
        <article class="blog">
            <div class="col-lg-7 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-lg-5">
                        <?= Html::a(Html::img($value->image,['class'=>'img-circle']),[$value->id] ) ?>
                    </div>
                    <div class="col-lg-5 text-center">
                        <h1 class="heading">
                            <?=Html::a($value->name, [$value->id], ['class' => 'profile-link'])?>
                        </h1>
                        <span class="label label-primary">Cloud Software Engineer</span>
                    </div>
                </div><hr>
                <!-- <div class="row">                   
                    <p><?=substr($value->description, 0, 360 );?></p>
                </div> -->

            </div>
        </article>
    </div><hr>
<?php endforeach; ?>


</div>
