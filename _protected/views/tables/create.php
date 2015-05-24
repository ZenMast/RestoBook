<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Table */

$this->title = Yii::t('app', 'Create Table');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 
    	'restaurantIds' => $restaurantIds,
    ]) ?>

</div>
