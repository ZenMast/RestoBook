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
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
                    <?= $form->field($model, 'email')?>
                    <?= $form->field($model, 'phone')->textInput(['maxlength' => 15]) ?>
                    <?= $form->field($model, 'comment')->textArea(['rows' => 6])  ?>
                    <?= Html::submitButton('Submit'); ?>
                    <?php ActiveForm::end(); ?>

                </div>
    		</div>
    		<div class="col-lg-4">
    			<?= Html::a('Back', ['/site/table_selection'], ['class'=>'btn btn-primary btn-sm']) ?>  
    			<?= Html::a('Next', ['/site/booking_confirmation'], ['class'=>'btn btn-primary btn-sm']) ?> 
    		</div>
    	</div>

    </div>
</div>
