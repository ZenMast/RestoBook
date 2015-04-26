<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('app', 'booking_confirmation');
?>
<div class="confirmation">
    <div class="body_confirmation">
    	<div class="row_confirmation">
    		<div class="col-lg-4">  
    			<h1>Booking confirmation:</h1>   	
                <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => Url::to(['site/create_booking']),
                ]); ?>
                <ul>
                <li> <label>Date</label>: <?= Html::encode($model->date) ?></li>
                <br>
                <li><label>Time</label>: <?= Html::encode($model->time) ?></li>
                <br>
                <li><label>Name</label>: <?= Html::encode($model->name) ?></li>
                <br>
                <li><label>Phone</label>: <?= Html::encode($model->phone) ?></li>
                <br>
                <li><label>Table number</label>: <?= Html::encode($model->tables) ?></li>
                <br>
                <li><label>People</label>: <?= Html::encode($model->people) ?></li>
                <br>
                <li><label>Comment</label>: <?= Html::encode($model->comment) ?></li>
                <br>
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
                </ul>
                <?= $form->field($model, 'date')->hiddenInput(['readonly' => true])->label(false) ?>
                <?= $form->field($model, 'time')->hiddenInput(['readonly' => true])->label(false) ?>
                <?= $form->field($model, 'name')->hiddenInput(['readonly' => true])->label(false) ?>
                <?= $form->field($model, 'phone')->hiddenInput(['readonly' => true])->label(false) ?>
                <?= $form->field($model, 'tables')->hiddenInput(['readonly' => true])->label(false) ?>
                <?= $form->field($model, 'people')->hiddenInput(['readonly' => true])->label(false) ?>
                <?= $form->field($model, 'comment')->hiddenInput(['readonly' => true])->label(false) ?>
                <?php ActiveForm::end(); ?>                   
            </div>
    	</div>
    </div>
</div>
