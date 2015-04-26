<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('app', 'booking_finish');
?>
<div class="finish">
    <div class="body_finish">
    	<div class="row_finish">
    		<div class="col-lg-4">               
            </div>
    		<div class="col-lg-4">
    			<div class="Information">   	
                    <?php $form = ActiveForm::begin([
                        'method' => 'post',
                        'action' => Url::to(['site/create_booking']),
                        ]); ?>
                            <?= $form->field($model, 'user_id')->hiddenInput(['readonly' => true])->label(false) ?>
                            <?= $form->field($model, 'date')->hiddenInput(['readonly' => true])->label(false) ?>
                            <?= $form->field($model, 'time')->hiddenInput(['readonly' => true])->label(false) ?>      
                            <?= $form->field($model, 'table_id')->hiddenInput(['readonly' => true])->label(false) ?>
                            <?= $form->field($model, 'people')->hiddenInput(['readonly' => true]) ->label(false) ?>    


                        <?php ActiveForm::end(); ?>
                     
                   
                </div>
    		</div>
    		<div class="col-lg-4">
    		</div>
    	</div>

    </div>