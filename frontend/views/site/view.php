<?php

use yii\helpers\Html;
use frontend\models\Post;

$this->title = 'view';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the view page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
    <div class="row">
        <article class="blog">
            <p><?=Yii::$app->formatter->asDate($model->created_at);?></p>
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <img src="<?=$model->img?>" class="img-rounded" alt="Cinque Terre"><hr>
                <h1 class="heading"><?=$model->titulo;?></h1>
                <p><?=$model->text?></p>
            </div>
        </article>
    </div>
</div>
