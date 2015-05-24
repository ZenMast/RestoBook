<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use janisto\timepicker\TimePicker;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\assets\GooglemapsAsset;
$this->title = Yii::t('app', 'table_selection');
GooglemapsAsset::register($this);
?>
<div class="table_selection">
	<div class="body">
    	<div class="row1">
            <div class="text-center">
                <ul class="pagination">
                    <li class="active"><a href="<?php Url::remember() ;?>">1</a></li>
                    <li><a href="index.php?r=site%2Fcontact_details">2</a></li>
                    <li><a href="index.php?r=site%2Fbooking_confirmation">3</a></li>     
                </ul>
            </div>
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
                    for ($i = 0; $i < sizeof($tables); ++$i){
                    	$tables_array[$tables[$i]->table_id] = "Table " . ($i + 1) . " max: " . $tables[$i]->max_people;                   	                    	
                    }?>
                    <?= $form->field($model, 'tables')->dropDownList($tables_array) ?>
                    <?= $form->field($model, 'people')->textInput(['value' => $model->people])?>
                    <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
                    <?php ActiveForm::end(); ?>                    
            	</div>     
            </div>
            <div class="col-lg-6">
                <body onload="initialize()" onunload="GUnload()">
                    <form action="#" onsubmit="showAddress(this.address.value); return false">
                        <input type="text" name="address" value="Please write your restaurant location..." />
                        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                        <div id="map_canvas"></div>
                    </form>
                </body>
            </div>
            <div class="col-lg-3">
                <ul>
                    <li><label>Restaurant</label>: <?= Html::encode($restaurant_data[0]->name ) ?></li>
                    <li><label>Website</label>: <?= Html::encode($restaurant_data[0]->website) ?></li>
                    <li><label>Email</label>: <?= Html::encode($restaurant_data[0]->email) ?></li>
                    <li><label>Phone</label>: <?= Html::encode($restaurant_data[0]->phone) ?></li>
                    <li><label>Location</label>:<?= Html::encode($restaurant_data[0]->country.",") ?><?= Html::encode($restaurant_data[0]->city.",") ?> <?= Html::encode($restaurant_data[0]->address) ?></li>
                    <li><label>Description</label>: <?= Html::encode($restaurant_data[0]->description) ?></li>
                </ul>
            </div>
    	</div>
    </div>
</div>
