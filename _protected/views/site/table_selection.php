<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use janisto\timepicker\TimePicker;
$this->title = Yii::t('app', 'table_selection');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table_selection">
	<div class="body">
    	<div class="row1">
    		<div class="col-lg-4">
    	  		<div class="Date1">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'date')-> widget(TimePicker::className(), [ 'name'  => 'book_date','mode' => 'date']) ?>
                    <?php ActiveForm::end(); ?>
            	</div>
            </div>
            <div class="col-lg-0">
            	        
            </div>
            <div class="col-lg-4">
            	<div class="Booking_time"> 
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'booking_time')-> widget(TimePicker::className(), [ 'name'  => 'book_time','mode' => 'time']) ?>
                    <?php ActiveForm::end(); ?>
            	</div>          
            </div>
            <div class="col-lg-4">  
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'tables')->dropDownList($tables, ['prompt'=>'--Table--']) ?>
                <?php ActiveForm::end(); ?>
            
                <?= Html::a('Next', ['/site/contact_details'], ['class'=>'btn btn-primary btn-sm']) ?>
                
                 <?= Html::submitButton(); ?>
            </div>

    	</div>
    </div>
</div>

