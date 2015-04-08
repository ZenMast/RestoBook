
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
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = Yii::t('app', Yii::$app->name);

?>
<!--index-->
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-md-2">
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
                       </div> 
                    <?php $form = ActiveForm::begin([
                    	'method' => 'get',
    					'action' => Url::to(['site/filter']),
                        //'action' => '/mailing-list/index',
                        ]); ?>
                    <?= $form->field($model, 'country')->dropDownList($country, ['prompt'=>'--Country--']) ?>
                    <?= $form->field($model, 'city')->dropDownList($city, ['prompt'=>'--City--']) ?>                 
                    <?= $form->field($model, 'restaurant')->dropDownList($restaurant, ['prompt'=>'--Restaurant--']) ?>                  
                    <?= $form->field($model, 'cuisine')->dropDownList($cuisines, ['prompt'=>'--Cuisine--']) ?> 
                    <?= $form->field($model, 'date')-> widget(TimePicker::className(), [ 'name'  => 'book_date','mode' => 'date']) ?>    
                    <?= $form->field($model, 'booking_time')-> widget(TimePicker::className(), [ 'name'  => 'book_time','mode' => 'time']) ?>
                    <?= $form->field($model, 'guests') ?>              	              
               		<?= Html::submitButton(Yii::t('app', 'Filter'), ['class' => 'btn btn-primary']) ?>
                    <?php ActiveForm::end(); ?>                          
			</div> 
            <div class="col-md-10">
            <div class="container-fluid">
            <?php for ($i = 0; $i < count($restaurants); ++$i){ ?>
            <?php if ($i % 3 == 0){echo '<div class="row">';} ?>
            <div class="col-md-4">
                    <?php $img = Html::img('http://www.92y.org/92streety/media/classes_events/food_drink/lg/food_whiskey_lg.jpg', ['width' => '250'])?>
                    <div class="row"><?= Html::a($img, ['site/table_selection', 'restaurant'=>$restaurants[$i]->name]) ?></div>
                    <div class="row"><?= Html::Label('Restaurant: '.$restaurants[$i]->name ) ?></div>
                    <div class="row"><?= Html::label('Location: '.$restaurants[$i]->address)?></div>   
                    <div class="row"><?= Html::label('Opened: '.$restaurants[$i]->opening_time.'-'.$restaurants[$i]->closing_time)?></div> 
                    <?php if(!empty($restaurants[$i]->cuisine)){echo '<div class="row">'.Html::label('Kitchen: '.$restaurants[$i]->cuisine).'</div>';} ?>
                    <?php if(!empty($restaurants[$i]->max_people)){echo '<div class="row">'.Html::label('Max: '.$restaurants[$i]->max_people).'</div>';} ?>                                                    
            </div>
            <?php if (($i + 1) % 3 == 0 ||$i == sizeof($restaurants)){echo '</div>';} ?>           	
            <?php } ?>	
            </div>	
          </div>	
          </div>			                          	
</div>	
</div>	
</div>	


