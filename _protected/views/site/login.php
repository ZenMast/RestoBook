<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\FbAsset;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */
$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;

FbAsset::register($this);
?>
<div class="site-login">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-lg-5 well bs-component">
        
        <?= yii\authclient\widgets\AuthChoice::widget([
        'baseAuthUrl' => ['site/auth']
		]) ?>
		
        <!--<div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="true" data-auto-logout-link="false"  data-scope="email,public_profile"></div>-->
        <p><?= Yii::t('app', 'Please fill out the following fields to login:') ?></p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'email') ?>        

        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div style="color:#999;margin:1em 0">
            <?= Yii::t('app', 'If you forgot your password you can') ?>
            <?= Html::a(Yii::t('app', 'reset it'), ['site/request-password-reset']) ?>.
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
		
        <?php ActiveForm::end(); ?>

    </div>
  
</div>