<?php
use yii\helpers\Html;

/* @var $message string */
?>
<div class="site-error">

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

</div>
