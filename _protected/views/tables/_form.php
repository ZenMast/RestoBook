<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\RestaurantSearch;
use app\models\Restaurant;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Table */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="table-form">

    <?php $form = ActiveForm::begin(); ?>
 
    <?= $form->field($model, 'max_people')->textInput() ?>

    <?= $form->field($model, 'restaurant_id')->dropDownList($restaurantIds) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
