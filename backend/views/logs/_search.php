<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VisitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ip') ?>

    <?= $form->field($model, 'module') ?>

    <?= $form->field($model, 'referrer') ?>

    <?= $form->field($model, 'new')->checkbox() ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'method') ?>

    <?php // echo $form->field($model, 'browser') ?>

    <?php // echo $form->field($model, 'os') ?>

    <?php // echo $form->field($model, 'device') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'csrfToken') ?>

    <?php // echo $form->field($model, 'port') ?>

    <?php // echo $form->field($model, 'user_agent') ?>

    <?php // echo $form->field($model, 'time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
