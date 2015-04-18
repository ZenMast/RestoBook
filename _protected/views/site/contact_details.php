<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->title = Yii::t('app', 'contact_details');
?>
<div class="details">
    <div class="body_details">
    	<div class="row_details">
    		<div class="col-lg-4">  
            </div>
    		<div class="col-lg-4">
    			<div class="Information">   							  	
                    <?php $form = ActiveForm::begin([
                        'method' => 'post',
                        'action' => Url::to(['site/booking_confirmation']),
                        ]); ?>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
                    <?= $form->field($model, 'email')?>
                    <?= $form->field($model, 'phone')->textInput(['maxlength' => 15]) ?>
                    <?= $form->field($model, 'comment')->textArea(['rows' => 6])  ?>
                    <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
                    <?= $form->field($model, 'date')->hiddenInput(['readonly' => true])->label(false) ?>
                    <?= $form->field($model, 'time')->hiddenInput(['readonly' => true])->label(false) ?>      
                    <?= $form->field($model, 'table')->hiddenInput(['readonly' => true])->label(false) ?>
                    <?= $form->field($model, 'people')->hiddenInput(['readonly' => true]) ->label(false) ?>
                    <?php ActiveForm::end(); ?>

                </div>
    		</div>
    		<div class="col-lg-4"> 
    		</div>
    	</div>

    </div>
</div>
