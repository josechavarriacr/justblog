<?php

use yii\helpers\Html;
$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

   <!--  <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p> -->

    <div class="col-lg-8 col-lg-offset-2">
        <img src="uploads/meta/giphy.gif" alt="">
    </div>

</div>
