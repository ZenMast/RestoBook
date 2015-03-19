<?php

namespace app\widgets;


use app\models\LoginForm;
use yii\bootstrap\Widget;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\authclient\widgets\AuthChoice;

class LoginWidget extends Widget
{
    public function run()
    {
    $model = new LoginForm();
    $form= ActiveForm::begin([
        'id' => 'login-form',
    	'action'=>array('site/login'),
    	'type' => ActiveForm::TYPE_INLINE,
        'formConfig' => ['showErrors' => true],
        'class'=>  'form-group kv-fieldset-inline',
    ]);
        

    echo $form->field($model, 'email');
    echo $form->field($model, 'password')->passwordInput();
    echo  Html::submitButton(\Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']);
    //echo '<div class="fb-login-button" data-max-rows="1" data-size="icon" data-auto-logout-link="false"></div>';
    echo  Html::a(\Yii::t('app', 'Reset password'), ['site/request-password-reset']);
    ActiveForm::end();
} } ?>
    
 
 
