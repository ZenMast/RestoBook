<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Restaurant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Restaurants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->restaurant_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->restaurant_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'restaurant_id',
            'name',
            'opening_time',
            'closing_time',
            'country',
            'city',
            'address',
            'cuisine',
            'vegetarian',
            'wifi',
            'max_people',
            'website',
            'email:email',
            'phone',
            'description',
        ],
    ]) ?>

</div>
