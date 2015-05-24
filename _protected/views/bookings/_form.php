<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use janisto\timepicker\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Booking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'table_id')->dropDownList($tables) ?>

    <?= $form->field($model, 'people')->textInput() ?>

    <?= $form->field($model, 'user_id')->dropDownList($users) ?>

    <?= $form->field($model, 'date')->widget(TimePicker::className(), [ 'name'  => 'book_date','mode' => 'date',
                        'clientOptions'=>[
                        'dateFormat' => 'yy-mm-dd'
                         ]]) ?>    

    <?= $form->field($model, 'time')->widget(TimePicker::className(), [ 'name'  => 'time','mode' => 'time']) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => 3000]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
