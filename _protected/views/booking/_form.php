<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Booking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'table_id')->dropDownList($tables) ?>

    <?= $form->field($model, 'people')->textInput() ?>

    <?= $form->field($model, 'user_id')->dropDownList($users) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
	    'options' => ['placeholder' => 'yyyy-mm-dd'],
	    'pluginOptions' => [
	        'autoclose'=>true,
    		'format' => 'yyyy-mm-dd'
	    ]
    ]) ?>

    <?= $form->field($model, 'time')->widget(TimePicker::classname(), ['pluginOptions' => [
        'showMeridian' => false,
        'minuteStep' => 5,
    ]]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => 3000]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
