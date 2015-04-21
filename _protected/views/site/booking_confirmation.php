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
            </div>
    		<div class="col-lg-4">
    			<div class="Information">  
    				<p>Booking confirmation:</p>   	
                     <?php $form = ActiveForm::begin([
                        'method' => 'post',
                        'action' => Url::to(['site/create_booking']),
                        ]); ?>
                        <?= $form->field($model, 'date')->textInput(['readonly' => true])->label('Date') ?>
                        <?= $form->field($model, 'time')->textInput(['readonly' => true])->label('Time') ?>      
                        <?= $form->field($model, 'name')->textInput(['readonly' => true])->label('Name') ?>
                        <?= $form->field($model, 'phone')->textInput(['readonly' => true])->label('Phone') ?>
                        <?= $form->field($model, 'tables')->textInput(['readonly' => true])->label('Table number') ?>
                        <?= $form->field($model, 'people')->textInput(['readonly' => true])->label('People') ?> 
                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>

                         
                    <?php ActiveForm::end(); ?>

                 
                   
                </div>
    		</div>
    		<div class="col-lg-4">
    		</div>
    	</div>

    </div>
</div>
