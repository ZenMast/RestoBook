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
//GooglemapsAsset::register($this);
?>

    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAjU0EJWnWPMv7oQ-jjS7dYxSPW5CJgpdgO_s4yyMovOaVh_KvvhSfpvagV18eOyDWu7VytS6Bi1CWxw"
      type="text/javascript"></script>
    <script>

    var map = null;
    var geocoder = null;

    function initialize() {
      if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById("map_canvas"));
        map.setCenter(new GLatLng(37.4419, -122.1419), 1);
        map.setUIToDefault();
        geocoder = new GClientGeocoder();
      }
    }

    function showAddress(address) {
      if (geocoder) {
        geocoder.getLatLng(
         address,
          function(point) {
            if (!point) {
              alert(address + " not found");
            } else {
              map.setCenter(point, 15);
              var marker = new GMarker(point, {draggable: true});
              map.addOverlay(marker);
            }
          }
        );
      }
    }
    </script>
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
                        <input type="text" style="width:350px" name="address" value="Please write your restaurant location..." />
                        <input type="submit" value="Search" />
                        <div id="map_canvas" style="width: 500px; height: 400px"></div>
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
