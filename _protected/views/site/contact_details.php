<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = Yii::t('app', 'contact_details');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="details">
    <div class="body_details">
    	<div class="row_details">
    		<div class="col-lg-4">
    			 <p></p>
    		</div>
    		<div class="col-lg-4">
    			<div class="Information">   							  	
    				<p>Contact Details:</p>		        
                    <p>Phone number: <input type="tel" pattern="\(\d\d\d\) ?\d\d\d-\d\d-\d\d" placeholder="(+372) ###-###-##"/></p>
                    <p>Name: <input type="text" autofocus maxlength="30"/></p> 
                    <p>E-mail: <input type="email"/></p>                 
                    <textarea name="comments" rows="6" cols="30">Comment section...</textarea>
                    <br>                 
                	<input class="button" name="button" type="submit" value="Submit"/>
                </div>
    		</div>
    		<div class="col-lg-4">
    			<?= Html::a('Back', ['/site/table_selection'], ['class'=>'btn btn-primary btn-sm']) ?>  
    			<?= Html::a('Next', ['/site/booking_confirmation'], ['class'=>'btn btn-primary btn-sm']) ?> 
    		</div>
    	</div>

    </div>
</div>
