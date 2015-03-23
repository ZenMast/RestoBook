
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use app\models\RestaurantSearch;
use kartik\select2\Select2;
use demogorgorn\ajax\AjaxSubmitButton;
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
                       
                       </div>
                </div>
                <div class="city">
                    <select name="action" size="1">
                    <option value="" >--City--</option>
                    <option value="Tartu">Tartu</option>
                    <option value="Tallinn">Tallinn</option>
                    <option value="Narva">Narva</option>
                    </select>
                </div>
                <br>
                <div class="restaurant">
                    <select name="action" size="1">
                    <option value="" >--Restaurant--</option>
                    <option value="Pierre">Pierre</option>
                    <option value="Volga">Volga</option>
                    <option value="Kapriis">Kapriis</option>
                    </select>
                </div>
                <br>
                <div class="kitchen">
                    <select name="action" size="1">
                    <option value="" >--Kitchen--</option>
                    <option value="italian">italian</option>
                    <option value="asian">asian</option>
                    <option value="european">european</option>
                    </select>
                </div>
                <br>
                <div class="Data">            
                    <?= DatePicker::widget(['name' => 'attributeName']) ?>

                </div>
                <br>
                <div class="Time_From"> 
                    <p>From:</p>   
                    <select name="Time_Hour">
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09" selected>09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    </select>
                    <select name="Time_Minute">
                    <option value="00">00</option>              
                    <option value="30" selected>30</option>                   
                    </select>                    
                </div>
                <br>
                <div class="Time_Till">            
                    <p>Till:</p>   
                    <select name="Time_Hour">
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09" selected>09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    </select>
                    <select name="Time_Minute">
                    <option value="00">00</option>               
                    <option value="30" selected>30</option>               
                    </select>
                </div>
                <br>
                <div class="Guests number">            
                    <p>Guests: <input type="number" id="guests" min="1" max="30"></p>                
                </div>
                <div class="FilterR">            
                    <br>
                    <input class="button" name="button" type="button" value="Filter"/>
                    <br>
                    <p>Realtime update <input type="checkbox"/></p>  
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
</div>

