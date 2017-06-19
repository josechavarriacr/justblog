<?php

use yii\helpers\Html;
use frontend\models\Post;
use kartik\ipinfo\IpInfo;
use kartik\popover\PopoverX;
use kartik\social\Disqus;
use frontend\components\Analytics;

Yii::$app->meta->getMetaTags($model->id);
?>
<div class="post-view">
    <code>Página generada en <?=Yii::$app->formatter->asDateTime(time(),'medium');?></code>
    <p>Me visitas desde<?=IpInfo::widget([
        'flagWrapperOptions' => [
        'class' => 'btn btn-lg btn-default'
        ],
        'popoverOptions' => [
        'placement' => PopoverX::ALIGN_BOTTOM_LEFT
        ]
        ]);?></p>

        <div class="row">
            <article class="blog">
                <!-- <?=Yii::$app->getRequest()->getUserIP()?> -->
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <?php if ($model->img): ?>
                        <img src="<?=$model->img?>" class="img-rounded center-block">
                    <?php endif ;?>
                    <hr>
                    <p>Redactado en <span class="label label-success"><?=Yii::$app->formatter->asDate($model->created_at);?></span></p>
                    <h1 class="heading"><?=$model->titulo;?></h1>
                    <p><?=$model->text?></p>
                </div>
            </article>
        </div><hr>

        <?php 
        $prev = Post::find()->where([ '<','id', $model->id])->andWhere(['type'=>'post'])->andWhere(['status'=>1])
        ->orderBy(['id'=>SORT_DESC])->one();

        $next =Post::find()->where(['>','id', $model->id])->andWhere(['type'=>'post'])->andWhere(['status'=>1])
        ->orderBy(['id'=>SORT_DESC])->one();
        ?>


        <div class="row">
         <div class="col-xs-6 col-xs-offset-1 col-md-3">
            <?php if ($prev!=null): ?>
                <div class="thumbnail">
                   <a href="<?= Html::encode($prev['url']) ?>">
                    <img class="img-responsive" src="<?= Html::encode($prev['img']) ?>">
                </a>
                <h3><a href="<?= Html::encode($prev['url']) ?>"><?= Html::encode($prev['titulo']) ?></a></h3>
                <p><?= Html::encode(substr($prev['descripcion'],0,200) ) ?></p>
                <div class="ratings">
                    <p class="pull-right"><?= Html::encode($prev['count'])?> Visitas</p>
                    <p>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                    </p>
                </div>
            </div>
        <?php endif; ?> 
    </div>



    <div class="col-xs-6 col-xs-offset-4 col-md-3">
        <?php if ($next!=null): ?> 
            <div class="thumbnail">
              <a href="<?= Html::encode($next['url']) ?>">
                <img class="img-responsive" src="<?= Html::encode($next['img']) ?>">
            </a>
           <h3><a href="<?= Html::encode($prev['url']) ?>"><?= Html::encode($next['titulo']) ?></a></h3>
            <p><?= Html::encode( substr($next['descripcion'], 0, 200) ) ?></p>
            <div class="ratings">
                <p class="pull-right"><?= Html::encode($next['count'])?> Visitas</p>
                <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                </p>
            </div>
        </div>
    <?php endif ;?>
</div>
</div>
<hr>


<div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
         <?=Disqus::widget(['settings'=>['shortname'=>'chavarria-cr']]);?> 
    </div>
</div>

</div>