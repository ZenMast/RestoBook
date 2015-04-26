<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\UserSearch;
$this->title = Yii::t('app', 'contact_details');
?>
<div class="details">
    <div class="body_details">
    	<div class="row_details">
    		<div class="col-lg-4">
    			<div class="Information">   							  	
                    <?php $form = ActiveForm::begin([
                        'method' => 'post',
                        'action' => Url::to(['site/booking_confirmation']),
                        ]); ?>

                    <?= $form->field($model, 'name')->textInput(['readonly' => true]) ?>
                    <?= $form->field($model, 'email')->textInput(['readonly' => true]) ?>
                    <?= $form->field($model, 'phone')->textInput(['readonly' => true]) ?>
                    <?= $form->field($model, 'comment')->textArea(['rows' => 6])  ?>
                    <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
                    <?= $form->field($model, 'date')->hiddenInput(['readonly' => true])->label(false) ?>
                    <?= $form->field($model, 'time')->hiddenInput(['readonly' => true])->label(false) ?>      
                    <?= $form->field($model, 'tables')->hiddenInput(['readonly' => true])->label(false) ?>
                    <?= $form->field($model, 'people')->hiddenInput(['readonly' => true]) ->label(false) ?>
                    <?php ActiveForm::end(); ?>
                </div>
    		</div>
    	</div>
    </div>
</div>
