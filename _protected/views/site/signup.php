<?php
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\FbAsset;


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\SignupForm */

$this->title = Yii::t('app', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
FbAsset::register($this);
?>
<div class="site-signup">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-lg-5 well bs-component">

        <p><?= Yii::t('app', 'Please fill out the following fields to signup:') ?></p>	 
	   <div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="true" data-auto-logout-link="false"  data-scope="email,public_profile"></div>
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>			
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->widget(PasswordInput::classname(), []) ?>
            <?= $form->field($model, 'password2')->passwordInput() ?>            
            <?= $form->field($model, 'name') ?>                
            <?= $form->field($model, 'phone') ?>
            <?= $form->field($model, 'facebook_id')->hiddenInput()->label(''); ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

		
        <?php ActiveForm::end(); ?>
        
		
        <?php if ($model->scenario === 'rna'): ?>
            <div style="color:#666;margin:1em 0">
                <i>*<?= Yii::t('app', 'We will send you an email with account activation link.') ?></i>
            </div>
        <?php endif ?>

    </div>
</div>