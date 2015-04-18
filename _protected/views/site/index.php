
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
                    <?php $form = ActiveForm::begin(); ?>            
                    <?= $form->field($model, 'country')->dropDownList(["All Countries"=>"All Countries"] + ArrayHelper::map($restaurants, 'country', 'country'),  ['options' =>[$model->country => ['selected ' => true]]]) ?>
                    <?= $form->field($model, 'city')->dropDownList(["All Cities"=>"All Cities"] + ArrayHelper::map($restaurants, 'city', 'city'),  ['options' =>[$model->city => ['selected ' => true]]]) ?>         
                    <?= $form->field($model, 'restaurant')->dropDownList(["All Restaurants"=>"All Restaurants"] + ArrayHelper::map($restaurants, 'name', 'name'),  ['options' =>[$model->restaurant => ['selected ' => true]]]) ?>                  
                    <?= $form->field($model, 'cuisine')->dropDownList(["All Cuisines"=>"All Cuisines"] + array_filter(ArrayHelper::map($restaurants, 'cuisine', 'cuisine')),  ['options' =>[$model->cuisine => ['selected ' => true]]]) ?>                  
                    <?= $form->field($model, 'date')-> widget(TimePicker::className(), [ 'name'  => 'book_date','mode' => 'date',  'options'=> ['dateFormat'=>'dd-mm-yy','value'=>date('d-m-Y')]]) ?>       
                    <?= $form->field($model, 'booking_time')-> widget(TimePicker::className(), [ 'name'  => 'book_time','mode' => 'time', 'options'=> ['dateFormat'=>'dd-mm-yy','value'=>date('H:i:s')]]) ?>
                    <?= $form->field($model, 'guests') ?>              	              
               		<?= Html::submitButton(Yii::t('app', 'Filter'), ['class' => 'btn btn-primary']) ?>
                    <?php ActiveForm::end(); ?>                          
			</div> 
            <div class="col-md-10">
            <div class="container-fluid">
            <?php for ($i = 0; $i < count($selected_restaurants); ++$i){ ?>
            <?php if ($i % 3 == 0){echo '<div class="row">';} ?>
            <div class="col-md-4">
                    <?php $img = Html::img('http://www.92y.org/92streety/media/classes_events/food_drink/lg/food_whiskey_lg.jpg', ['width' => '250'])?>
                    <div class="row"><?= Html::a($img, ['site/table_selection', 'restaurant_name'=>$selected_restaurants[$i]->name],[
                    'data' =>  [
                     'method' => 'post'
                    ],]) ?></div>
                    <div class="row"><?= Html::Label('Restaurant: '.$selected_restaurants[$i]->name ) ?></div>
                    <div class="row"><?= Html::label('Location: '.$selected_restaurants[$i]->country.", ".$selected_restaurants[$i]->city.", ".$selected_restaurants[$i]->address)?></div>   
                    <div class="row"><?= Html::label('Opened: '.$selected_restaurants[$i]->opening_time.'-'.$selected_restaurants[$i]->closing_time)?></div> 
                    <?php if(!empty($selected_restaurants[$i]->cuisine)){echo '<div class="row">'.Html::label('Kitchen: '.$selected_restaurants[$i]->cuisine).'</div>';} ?>
                    <?php if(!empty($selected_restaurants[$i]->max_people)){echo '<div class="row">'.Html::label('Max: '.$selected_restaurants[$i]->max_people).'</div>';} ?>                                                   
            </div>
            <?php if (($i + 1) % 3 == 0 ||$i == sizeof($selected_restaurants)){echo '</div>';} ?>           	
            <?php } ?>	
            </div>	
          </div>	
          </div>			                          	
</div>	
</div>	
</div>	


