<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use janisto\timepicker\TimePicker;
use yii\helpers\Url;
$this->title = Yii::t('app', 'table_selection');

?>
<div class="table_selection">
	<div class="body">
    	<div class="row1">
            <div class="col-lg-12">  
                <ul class="pager">
                    <li class="previous"><a href="index.php?r=site">Previous</a></li>
                </ul>
            </div>
    		<div class="col-lg-3">
    	  		<div class="Date1">
                    <?php $form = ActiveForm::begin([
                        'method' => 'post',
                        'action' => Url::to(['site/contact_details']),
                        ]); ?>
                    <?= $form->field($model, 'date')-> widget(TimePicker::className(), [ 'name'  => 'book_date','mode' => 'date']) ?>    
                    <?= $form->field($model, 'time')-> widget(TimePicker::className(), [ 'name'  => 'time','mode' => 'time']) ?>
                    <?= $form->field($model, 'table')->dropDownList($table, ['prompt'=>'--Table--']) ?>
                    <?= $form->field($model, 'people') ?>
                    <?= $form->field($model, 'restaurant_name')->textInput(['readonly' => true])->label('Restaurant')?> 
                    <br> 
                    <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
                    <?php ActiveForm::end(); ?>
            	</div>          
            </div>
            <div class="col-lg-3">  
                <br>
            </div>
    	</div>
    </div>
</div>

