<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
$this->title = Yii::t('app', 'table_selection');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table_selection">
	<div class="body">
    	<div class="row1">
    		<div class="col-lg-3">
    	  		<div class="Date1">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'date')->dropDownList($date, ['prompt'=>'--Date--']) ?>                    
                    <?= $form->field($model, 'booking_time')->dropDownList($booking_time, ['prompt'=>'--Booking time--']) ?>
                    <?= 'You selected: '.$restaurant ?>
                    <?php ActiveForm::end(); ?>
            	</div>          
            </div>
            <div class="col-lg-3">  
                <br>
                <br>
                <br>           
                <?= Html::a('Next', ['/site/contact_details'], ['class'=>'btn btn-primary btn-sm']) ?>
                <br>
                <br>
                <br>
                <input class="button" name="button" type="submit" value="Submit"/>
            </div>

    	</div>
    </div>
</div>

