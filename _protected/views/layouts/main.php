<?php
use app\assets\AppAsset;
use app\widgets\Alert;
use app\widgets\LoginWidget;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Yii::t('app', Yii::$app->name),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'id' => 'navbar-first',
                    'class' => 'navbar navbar-default',
                    'renderInnerContainer' => false,
                ],
            ]);

            // everyone can see Home page
            //$menuItems[] = ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']];
            

            // we do not need to display index, About and Contact pages to editor+ roles
            if (!Yii::$app->user->can('editor')) 
            {
                $menuItems[] = ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']];
                $menuItems[] = ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']];
            }         

            // display Users to admin+ roles
            if (Yii::$app->user->can('admin'))
            {
                $menuItems[] = ['label' => Yii::t('app', 'Users'), 'url' => ['/user/index']];
                $menuItems[] = ['label' => Yii::t('app', 'Restaurants'), 'url' => ['/restaurant/index']];
                $menuItems[] = ['label' => Yii::t('app', 'Cuisines'), 'url' => ['/cuisine/index']];
                $menuItems[] = ['label' => Yii::t('app', 'Tables'), 'url' => ['/table/index']];
                $menuItems[] = ['label' => Yii::t('app', 'Bookings'), 'url' => ['/booking/index']];
            }
            
            // display Signup and Login pages to guests of the site
            if (Yii::$app->user->isGuest) 
            {
                $menuItems[] = ['label' => Yii::t('app', 'Signup'), 'url' => ['/site/signup']];
                $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
                                
               /*echo Nav::widget([
                'options' => ['class' => 'navbar-nav pull-right', 'renderInnerContainer' => false ],
                'items' => [loginWidget::widget()]
            ]);*/
            
	           
            }
            // display Logout to all logged in users
            else 
            {
                $menuItems[] = [
                    'label' => Yii::t('app', 'Logout'). ' (' . Yii::$app->user->identity->email . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav pull-right', 'renderInnerContainer' => false ],
                'items' => $menuItems,
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav pull-left', 'renderInnerContainer' => false ],
                'items' => [Html::img("http://kodu.ut.ee/~zen_mast/RestoBook/banner.png")],
            ]);
            NavBar::end();
        ?>
        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
        
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; <?= Yii::t('app', Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
