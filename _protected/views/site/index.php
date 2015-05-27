
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
use app\assets\FilterAsset;

$this->title = Yii::t('app', Yii::$app->name);
FilterAsset::register($this);
?>
<!--index-->
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-md-3 col-lg-2 col-s-12">               
                    <?php $form = ActiveForm::begin(); ?>            
                    <?= $form->field($model, 'country')->dropDownList(["All Countries"=>"All Countries"] + ArrayHelper::map($restaurants, 'country', 'country'),  ['options' =>[$model->country => ['selected ' => true]], 'onchange'=>'selectedCountry()']) ?>
                    <?= $form->field($model, 'city')->dropDownList(["All Cities"=>"All Cities"] + ArrayHelper::map($restaurants, 'city', 'city'),  ['options' =>[$model->city => ['selected ' => true]], 'onchange'=>'selectedCountry()']) ?>         
                    <?= $form->field($model, 'restaurant')->dropDownList(["All Restaurants"=>"All Restaurants"] + ArrayHelper::map($restaurants, 'name', 'name'),  ['options' =>[$model->restaurant => ['selected ' => true]]]) ?>                  
                    <?= $form->field($model, 'cuisine')->dropDownList(["All Cuisines"=>"All Cuisines"] + array_filter(ArrayHelper::map($restaurants, 'cuisine', 'cuisine')),  ['options' =>[$model->cuisine => ['selected ' => true]]]) ?>                              	              
<!--               		<?= $form->field($model, 'vegetarian')->checkbox()?>-->
<!--    				<?= $form->field($model, 'wifi')->checkbox() ?>-->
               		<?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                    <?php ActiveForm::end(); ?>                          
			</div> 
            <div class="col-md-9 col-lg-10 col-s-12">
            <div class="container-fluid">
            <?php for ($i = 0; $i < count($selected_restaurants); ++$i){ ?>
            <?php if ($i % 3 == 0){echo '<div class="row">';} ?>
            <div class="col-md-9 col-lg-4 col-s-12">
            <div class="panel panel-default">            		
             		<div class="panel-heading text-center"><?= Html::Label($selected_restaurants[$i]->name) ?></div>                              
                    <div class="panel-body">
                    <?php $img = Html::img('http://rabotai.in/ideas7/img/710.jpg', [ 'class' => "img-responsive center-block"])?>
                    <div class="row"><?= Html::a($img, ['site/table_selection', 'Reservation[restaurant_id]'=>$selected_restaurants[$i]->restaurant_id]) ?></div>                    
                    <div class="row "><?= Html::Label($selected_restaurants[$i]->description)?></div>
            		<div class="row "><?= Html::label('Location: '.$selected_restaurants[$i]->country.", ".$selected_restaurants[$i]->city.", ".$selected_restaurants[$i]->address)?></div>   
                    <div class="row "><?= Html::label('Opened: '.$selected_restaurants[$i]->opening_time.'-'.$selected_restaurants[$i]->closing_time)?></div> 
                    <?php if(!empty($selected_restaurants[$i]->cuisine)){echo '<div class="row">'.Html::label('Kitchen: '.$selected_restaurants[$i]->cuisine).'</div>';} ?>
                    <?php if(!empty($selected_restaurants[$i]->max_people)){echo '<div class="row">'.Html::label('Max: '.$selected_restaurants[$i]->max_people).'</div>';} ?>                                                                                   			 
			 </div>
			 </div>
             </div>
            <?php if (($i + 1) % 3 == 0 ||$i == sizeof($selected_restaurants)){echo '</div>';} ?>           	
            <?php } ?>	
            </div>	
          </div>	
          </div>			                          	
</div>	
</div>	
</div>	


