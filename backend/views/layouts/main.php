<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
$user = Yii::$app->user->id;
?>
<?= Html::csrfMetaTags() ?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<meta name="robots" content="noindex, nofollow" />
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Yii::$app->site->getIcon();?>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => '<span class="glyphicon glyphicon-home"></span>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
            ],
            ]);
        $menuItems = [
        ['label' => '<span class="fa fa-id-card-o"></span> Info',
            'items' => [
                 ['label' => ' <span class="fa fa-user"></span> Profile', 'url' => ['/profile/view/'.$user]],
                 '<li class="divider"></li>',
                 ['label' => '<span class="fa fa-flag"></span> MetaTags', 'url' => ['/metatag/view/'.$user]],
                 '<li class="divider"></li>',
                 ['label' => '<span class="fa fa-pencil-square-o "></span> About', 'url' => ['/about/index']],
            ],
        ],
        ['label' => '<span class="glyphicon glyphicon-book"></span> Post',
            'items' => [
                 ['label' => ' <span class="fa fa-list-alt"></span> All Post', 'url' => ['/post/index']],
                 '<li class="divider"></li>',
                 ['label' => '<span class="glyphicon glyphicon-folder-open"></span> Category', 'url' => ['/category/index']],
                 '<li class="divider"></li>',
                 ['label' => '<span class="glyphicon glyphicon-tags"></span> Tags', 'url' => ['/tag/index']],
            ],
        ],
        ['label' => '<span class="glyphicon glyphicon-wrench"></span> Advanced',
            'items' => [
                 ['label' => '<span class="fa fa-briefcase"></span> Settings', 'url' => ['/settings/settings']],
                 '<li class="divider"></li>',
                 ['label' => '<span class="fa fa-server"></span> Logs', 'url' => ['/logs/index']],
                 '<li class="divider"></li>',
                  ['label' => '<span class="fa fa-bar-chart"></span> Analytics', 'url' => ['/analytics/charts']],
            ],
        ],

        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => '<span class="fa fa-sign-in"></span> Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
                )
            . Html::endForm()
            . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
            'encodeLabels' => false,
            ]);
        NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
        
        <!-- start footer -->
        <?php $this->beginContent('@app/views/layouts/footer.php'); ?>
        <?php $this->endContent(); ?>
        <!-- end footer -->
        
        <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
