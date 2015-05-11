<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = Yii::t('app', 'booking_confirmation');
?>
<div class="confirmation">
    <div class="body_confirmation">   
    			<h1>Booking confirmation</h1>    			   	
                <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => Url::to(['site/create_booking']),
                ]); ?> 
                 <div class="col-lg-4">             
                <?= Html::ul(['Date: '.$model->date,
                		'Time: '.$model->time,
                		'Name: '.$model->name,
                		'Phone: '.$model->phone,
                		'Table number: '.$model->tables,
                		'People: '.$model->people,
                		'Comment: '.$model->comment,],
                		['class' => 'confirmation-list']
                		)?>
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?> 
               </div>          
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
