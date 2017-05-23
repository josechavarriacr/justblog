<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Metatag */

$this->title = 'Create Metatag';
$this->params['breadcrumbs'][] = ['label' => 'Metatags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metatag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
