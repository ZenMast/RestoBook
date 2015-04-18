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
                        'action' => Url::to(['site/booking_confirmation']),
                        ]); ?>
                        <?= $form->field($model, 'restaurant_name')->textInput(['readonly' => true])->label('Restaurant')?> 
                        <?= $form->field($model, 'date')->textInput(['readonly' => true])->label('Date') ?>
                        <?= $form->field($model, 'time')->textInput(['readonly' => true])->label('Time') ?>      
                        <?= $form->field($model, 'name')->textInput(['readonly' => true])->label('Name') ?>
                        <?= $form->field($model, 'phone')->textInput(['readonly' => true])->label('Phone') ?>
                        <?= $form->field($model, 'table')->textInput(['readonly' => true])->label('Table number') ?>
                        <?= $form->field($model, 'people')->textInput(['readonly' => true])->label('People') ?> 
                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
                         
                    <?php ActiveForm::end(); ?>
                 
                   
                </div>
    		</div>
    		<div class="col-lg-4">
    			 <p>
                  
                   <br>  
                   <br>  
                   <br>  
                   
                 </p>
    		</div>
    	</div>

    </div>
</div>
