<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Restaurant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'opening_time')-> widget(TimePicker::classname(), ['pluginOptions' => [
        'showMeridian' => false,
        'minuteStep' => 5,
    ]]) ?>

    <?= $form->field($model, 'closing_time')-> widget(TimePicker::classname(), ['pluginOptions' => [
        'showMeridian' => false,
        'minuteStep' => 5,
    ]]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'cuisine')->dropDownList($cuisines) ?>

    <?= $form->field($model, 'vegetarian')->checkbox() ?>

    <?= $form->field($model, 'wifi')->checkbox() ?>

    <?= $form->field($model, 'max_people')->textInput() ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => 300]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 300]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 20000]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
