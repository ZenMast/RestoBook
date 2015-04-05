
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use app\models\RestaurantSearch;
use janisto\timepicker\TimePicker;
use kartik\select2\Select2;
use demogorgorn\ajax\AjaxSubmitButton;
use app\models\Cuisine;
use app\models\CuisineSearch;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', Yii::$app->name);

?>
<!--index-->
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <div id="ajaxusage">
                   <!--     Ajax usage -->
                   <?php echo Html::beginForm('', 'post', ['class'=>'uk-width-medium-1-1 uk-form uk-form-horizontal']); ?>
               
                       <?= Select2::widget([
                           'name' => 'resto_id',
                           'data' => RestaurantSearch::findAllIdsToAssocString(),
                           'options' => [
                               'id' => 'resto_select',
                               'multiple' => false, 
//                                 'placeholder' => 'Choose...',
                               'class' => 'uk-width-medium-7-10']
                            ]);
                       ?>
                       
                       Click for Ajax
                       <?php AjaxSubmitButton::begin([
                           'label' => 'Check',
                           'ajaxOptions' => [
                               'type'=>'POST',
                               'url' => 'index.php?r=site%2Fgetinfo',
                               /*'cache' => false,*/
                               'success' => new \yii\web\JsExpression('function(html){
                                   $("#output").html(html);
                                   }'),                
                           ],
                           'options' => ['class' => 'customclass', 'type' => 'submit'],
                           ]);
                           AjaxSubmitButton::end();
                       ?>
                       
                       <?php echo Html::endForm(); ?>
                       
                       <div id="output">
                         <br>
                       </div>
                </div>
                <div class="filter">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'country')->dropDownList($country, ['prompt'=>'--Country--']) ?>
                    <?= $form->field($model, 'city')->dropDownList($city, ['prompt'=>'--City--']) ?>                 
                    <?= $form->field($model, 'restaurant')->dropDownList($restaurant, ['prompt'=>'--Restaurant--']) ?>                  
                    <?= $form->field($model, 'cuisine')->dropDownList($cuisines, ['prompt'=>'--Cuisine--']) ?>
                    <br>
                    <?= $form->field($model, 'date')-> widget(TimePicker::className(), [ 'name'  => 'book_date','mode' => 'date']) ?>
                    <br>
                    <?= $form->field($model, 'booking_time')-> widget(TimePicker::className(), [ 'name'  => 'book_time','mode' => 'time']) ?>
                    <br>
                    <?= $form->field($model, 'guests')->dropDownList($guests, ['prompt'=>'--Guests--']) ?>
                    <?= Html::submitButton('Filter'); ?>
                    <?php ActiveForm::end(); ?>       
                </div>
            </div>
            <div class="col-lg-8"> 
                <?php $result = RestaurantSearch::findAllInfIds('name','address');
                    foreach ($result as $namerestaurant)
                    echo 'Restaurant: '.$namerestaurant->name.'<br/><br/>',
                    'Location: '.$namerestaurant->address.'<br/><br/>',
                    Html::a('Book', ['/site/table_selection'], ['class'=>'btn btn-primary']).'<br/><br/>'
                ?>
            </div>
            <div class="col-lg-0">
                       
            </div>
        </div>
    </div>
</div>


