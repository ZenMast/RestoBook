<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use janisto\timepicker\TimePicker;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'table_selection');

?>
<div class="table_selection">
	<div class="body">
    	<div class="row1">
    		<div class="col-lg-3">
    	  		<div class="Date1">
                    <?php $form = ActiveForm::begin([
                        'method' => 'post',
                        'action' => Url::to(['site/contact_details']),
                        ]); ?>
                    <?= $form->field($model, 'date')-> widget(TimePicker::className(), ['mode' => 'date',
                        'clientOptions'=>[
                        'dateFormat' => 'yy-mm-dd'
                         ]]) ?>    
                    <?= $form->field($model, 'time')-> widget(TimePicker::className(), ['mode' => 'time']) ?>
                    <?php $tables_array = null;                   
                    for ($i = 0; $i <= max(array_map('count', $tables)); ++$i){
                    	$tables_array[$tables[$i]->table_id] = "Table " . ($i + 1) . " max: " . $tables[$i]->max_people;                   	                    	
                    }?>
                    <?= $form->field($model, 'tables')->dropDownList($tables_array) ?>
                    <?= $form->field($model, 'people')->textInput(['value' => $model->people])?>
                    <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
                    <?php ActiveForm::end(); ?>                    
            	</div> 
            	<?= Html::Label('Restaurant: '.$restaurant_data[0]->name ) ?>  
            	<?= Html::Label('Description, Googlemap etc'  ) ?>     
            </div>
    	</div>
    </div>
</div>

