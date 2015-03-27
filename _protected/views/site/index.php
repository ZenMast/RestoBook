
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use app\models\RestaurantSearch;
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
                 <div class="country">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'country')->dropDownList($country, ['prompt'=>'--Country--']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="city">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'city')->dropDownList($city, ['prompt'=>'--City--']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="restaurant">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'restaurant')->dropDownList($city, ['prompt'=>'--Restaurant--']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="kitchen">
                  <?php $form = ActiveForm::begin(); ?>
                  <?= $form->field($model, 'cuisine')->dropDownList($cuisines, ['prompt'=>'--Cuisine--']) ?>
                  <?php ActiveForm::end(); ?>          
                </div>
                <div class="Data">  
                     <p>Date</p>          
                    <?= DatePicker::widget(['name' => 'attributeName']) ?>

                </div>
                <div class="Time_From"> 
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'opening_time')->dropDownList($opening_time, ['prompt'=>'--Opening--']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="Time_Till"> 
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'closing_time')->dropDownList($closing_time, ['prompt'=>'--Closing--']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="Guests number">            
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'guests')->dropDownList($guests, ['prompt'=>'--Guests--']) ?>
                    <?php ActiveForm::end(); ?>       
                </div>
                <div class="FilterR">            
                    <?php
                        if(isset($_POST['realtimeup']) && 
                           $_POST['realtimeup'] == 'No') 
                        {
                            echo "Don't need realtime update.";
                        }
                        else
                        {
                            echo "Need realtime update.";
                        }    
                         
                    ?>
                    <input type="checkbox" name="realtimeup" value="No" />
                    

                </div>
                <br>

            </div>
            <div class="col-lg-4"> 
                <p>Restaurant Test</p>
                <p>Location:Tartu Raatuse 1</p>
                <p>Opened: 8:00-22:00</p>
                <p>Kitchen:Italian</p>
                <p>Max: 20 ppl</p>
                <p>"We have best pizza in town"</p>
                <?= Html::a('View', ['/site/table_selection'], ['class'=>'btn btn-primary']) ?>


                    
            </div>
            <div class="col-lg-4">    
                <p>Restaurant Test2</p>
                <p>Location:Tartu Raekoja plats 3</p>
                <p>Opened: 9:00-23:00</p>
                <p>Kitchen:european</p>
                <p>Max: 100 ppl</p>
                <p>"Modern cooking methods, the freshest of ingredients."</p>
                <?= Html::a('View', ['/site/table_selection'], ['class'=>'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>


