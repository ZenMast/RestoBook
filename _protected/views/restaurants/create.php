<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Restaurant */

$this->title = Yii::t('app', 'Create Restaurant');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Restaurants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'cuisines' => $cuisines,
    ]) ?>

</div>
