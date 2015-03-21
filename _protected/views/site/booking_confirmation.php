<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = Yii::t('app', 'booking_confirmation');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="confirmation">
    <div class="body_confirmation">
    	<div class="row_confirmation">
    		<div class="col-lg-4">
    			 <p></p>
    		</div>
    		<div class="col-lg-4">
    			<div class="Information">  
    				<p>Booking confirmation:</p>   			        
                   
                </div>
    		</div>
    		<div class="col-lg-4">
    			 <p>
                   <?= Html::a('Back', ['/site/contact_details'], ['class'=>'btn btn-primary btn-sm']) ?> 
                   <br>  
                   <br>  
                   <br>  
                   <input class="button" name="button" type="submit" value="Submit"/>
                 </p>
    		</div>
    	</div>

    </div>
</div>
