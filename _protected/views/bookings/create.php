<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Booking */

$this->title = Yii::t('app', 'Create Booking');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bookings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'tables' => $tables,
    	'users' => $users,
    ]) ?>

</div>
