<?php
namespace app\controllers;

use app\models\User;
use app\models\LoginForm;
use app\models\AccountActivation;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\ContactForm;
use app\widgets\LoginWidget;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\CuisineSearch;
use app\models\RestaurantSearch;
use app\models\TableSearch;
use app\models\BookingSearch;
use app\models\FilterForm;
use app\models\Form;
use Yii;
/**
 * Site controller.
 * It is responsible for displaying static pages, logging users in and out,
 * sign up and account activation, password reset.
 */
class SiteController extends Controller
{
    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    
    public function actionGetinfo()
    {
    	 
    	if(!isset($_POST['resto_id']) || empty($_POST['resto_id']))
    		return;
    
    	$rest_id = $_POST['resto_id'];
    
    	return $this->renderAjax('ajaxexample', ['message' => "THIS IS AJAX CALL DESIGNED JUST FOR SAKE OF EXTRA PROJECT POINT AND YOU CHOSE NR. " . $rest_id]);
    }

    /**
     * Declares external actions for the controller.
     *
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        	'auth' => [
        				'class' => 'yii\authclient\AuthAction',
        				'successCallback' => [$this, 'successCallback'],
        	],
        	
        ];
    }
    
    
    public function successCallback($client)
    {
    	$attributes = $client->getUserAttributes();
    	// user login or signup comes here
    	$user = User::find()
    	->where([
    			'email'=>$attributes['email'],
    	])
    	->one();
    	if(!empty($user)){
    		Yii::$app->user->login($user);
    	}
    	else{
    		Yii::$app->session->setFlash('error',
    				Yii::t('app', 'User not found.'));
    		
    	}
    }

//------------------------------------------------------------------------------------------------//
// STATIC PAGES
//------------------------------------------------------------------------------------------------//

    /**
     * Displays the index (home) page.
     * Use it in case your home page contains static content.
     *
     * @return string
     */
    public function actionIndex()
    {
        /*return $this->render('index');*/
        $country = ArrayHelper::map(RestaurantSearch::countryDistinct(), 'country', 'country');
        $city = ArrayHelper::map(RestaurantSearch::cityDistinct(), 'city', 'city');
        $restaurant = ArrayHelper::map(RestaurantSearch::rstaurantDistinct(), 'name', 'name');
        $cuisines = ArrayHelper::map(CuisineSearch::findAllNamesIds(), 'cuisine_id', 'cuisine');
        $guests = ArrayHelper::map(TableSearch::findAllIds(), 'table_id', 'max_people');
        $date = ArrayHelper::map(BookingSearch::findAllbds(), 'booking_id','date');
        $booking_time = ArrayHelper::map(BookingSearch::findAllbds(), 'booking_id','booking_time');
        $model = new FilterForm();
        return $this->render('index', [
                'model' => $model,
                'restaurant'=> $restaurant,
                'country' => $country,
                'city' => $city,
                'guests' => $guests,
                'cuisines' => $cuisines,
                'date' => $date,
                'booking_time' => $booking_time,
            ]);
     
    }
     public function actionFilter()
    {  
     $country = $_GET['country'];
      
     $restaurants=new RestaurantSearch($country);
     
     $country = ArrayHelper::map(RestaurantSearch::searchRestaurantsByWhere(), 'country', 'country');
    
     return $this->render('index',[
      'restaurants'=> $restaurants,
      ]);
    }
       /* $country = ArrayHelper::map(RestaurantSearch::searchRestaurantsByWhere(), 'country', 'country');
        $city = ArrayHelper::map(RestaurantSearch::searchRestaurantsByWhere(), 'city', 'city');
        $restaurant = ArrayHelper::map(RestaurantSearch::searchRestaurantsByWhere(), 'name', 'name');
        $cuisines = ArrayHelper::map(CuisineSearch::searchRestaurantsByWhere(), 'cuisine', 'cuisine');
        $guests = ArrayHelper::map(TableSearch::searchRestaurantsByWhere(), 'max_people', 'max_people');
        //$restaurants->Array(['country','city', 'restaurant','cuisine','guests']);
        return $this->render('index',[
                'restaurants'=> $restaurants,
            ]
            );
     */
    /*return $this->render('index',[
                'restaurants'=> $restaurants,
            ]);
*/
    

    /**
     * Displays the about static page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays the contact static page and sends the contact email.
     *
     * @return string|\yii\web\Response
     */
    public function actionContact()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            if ($model->contact(Yii::$app->params['adminEmail'])) 
            {
                Yii::$app->session->setFlash('success', 
                    Yii::t('app', 'Thank you for contacting us. We will respond to you as soon as possible.'));
            } 
            else 
            {
                Yii::$app->session->setFlash('error', Yii::t('app', 'There was an error sending email.'));
            }

            return $this->refresh();
        } 
        else 
        {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

//------------------------------------------------------------------------------------------------//
// LOG IN / LOG OUT / PASSWORD RESET
//------------------------------------------------------------------------------------------------//

    /**
     * Logs in the user if his account is activated,
     * if not, displays appropriate message.
     *
     * @return string|\yii\web\Response
     */
public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) 
        {
            return $this->goHome();
        }
        // get setting value for 'Login With Email'
        $lwe = Yii::$app->params['lwe'];
        // if 'lwe' value is 'true' we instantiate LoginForm in 'lwe' scenario
        $model = $lwe ? new LoginForm(['scenario' => 'lwe']) : new LoginForm();
        // now we can try to log in the user
        if ($model->load(Yii::$app->request->post()) && $model->login()) 
        {
            return $this->goBack();
        }
        // user couldn't be logged in, because he has not activated his account
        elseif($model->status === User::STATUS_NOT_ACTIVE)
        {
            // if his account is not activated, he will have to activate it first
            Yii::$app->session->setFlash('error', 
                Yii::t('app', 'You have to activate your account first. Please check your email.'));
            return $this->refresh();
        }    
        // account is activated, but some other errors have happened
        else
        {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    
    
        
    /**
     * Logs out the user.
     *
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

/*----------------*
 * PASSWORD RESET *
 *----------------*/

    /**
     * Sends email that contains link for password reset action.
     *
     * @return string|\yii\web\Response
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            if ($model->sendEmail()) 
            {
                Yii::$app->getSession()->setFlash('success', 
                    Yii::t('app', 'Check your email for further instructions.'));

                return $this->goHome();
            } 
            else 
            {
                Yii::$app->getSession()->setFlash('error', 
                    Yii::t('app', 'Sorry, we are unable to reset password for email provided.'));
            }
        }
        else
        {
            return $this->render('requestPasswordResetToken', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Resets password.
     *
     * @param  string $token Password reset token.
     * @return string|\yii\web\Response
     *
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try 
        {
            $model = new ResetPasswordForm($token);
        } 
        catch (InvalidParamException $e) 
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) 
            && $model->validate() && $model->resetPassword()) 
        {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'New password was saved.'));

            return $this->goHome();
        }
        else
        {
            return $this->render('resetPassword', [
                'model' => $model,
            ]);
        }       
    }    

//------------------------------------------------------------------------------------------------//
// SIGN UP / ACCOUNT ACTIVATION
//------------------------------------------------------------------------------------------------//

    /**
     * Signs up the user.
     * If user need to activate his account via email, we will display him
     * message with instructions and send him account activation email
     * ( with link containing account activation token ). If activation is not
     * necessary, we will log him in right after sign up process is complete.
     * NOTE: You can decide whether or not activation is necessary,
     * @see config/params.php
     *
     * @return string|\yii\web\Response
     */
    public function actionSignup()
    {  
        // get setting value for 'Registration Needs Activation'
        $rna = Yii::$app->params['rna'];

        // if 'rna' value is 'true', we instantiate SignupForm in 'rna' scenario
        $model = $rna ? new SignupForm(['scenario' => 'rna']) : new SignupForm();

        // collect and validate user data
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            // try to save user data in database
            if ($user = $model->signup()) 
            {
                // if user is active he will be logged in automatically ( this will be first user )
                if ($user->status === User::STATUS_ACTIVE)
                {
                    if (Yii::$app->getUser()->login($user)) 
                    {
                        return $this->goHome();
                    }
                }
                // activation is needed, use signupWithActivation()
                else 
                {
                    $this->signupWithActivation($model, $user);

                    return $this->refresh();
                }            
            }
            // user could not be saved in database
            else
            {
                // display error message to user
                Yii::$app->session->setFlash('error', 
                    Yii::t('app', 'We couldn\'t sign you up, please contact us.'));

                // log this error, so we can debug possible problem easier.
                Yii::error('Signup failed! 
                    User '.Html::encode($user->username).' could not sign up.
                    Possible causes: something strange happened while saving user in database.');

                return $this->refresh();
            }
        }
                
        return $this->render('signup', [
            'model' => $model,
        ]);     
    }

    /**
     * Sign up user with activation.
     * User will have to activate his account using activation link that we will
     * send him via email.
     *
     * @param $model
     * @param $user
     */
    private function signupWithActivation($model, $user)
    {
        // try to send account activation email
        if ($model->sendAccountActivationEmail($user)) 
        {
            Yii::$app->session->setFlash('success', 
                Yii::t('app', 'Hello').' '.Html::encode($user->username). '. ' .
                Yii::t('app', 'To be able to log in, you need to confirm your registration. Please check your email, we have sent you a message.'));
        }
        // email could not be sent
        else 
        {
            // display error message to user
            Yii::$app->session->setFlash('error', 
                Yii::t('app', 'We couldn\'t send you account activation email, please contact us.'));

            // log this error, so we can debug possible problem easier.
            Yii::error('Signup failed! 
                User '.Html::encode($user->username).' could not sign up.
                Possible causes: verification email could not be sent.');
        }
    }

/*--------------------*
 * ACCOUNT ACTIVATION *
 *--------------------*/

    /**
     * Activates the user account so he can log in into system.
     *
     * @param  string $token
     * @return \yii\web\Response
     *
     * @throws BadRequestHttpException
     */
    public function actionActivateAccount($token)
    {
        try 
        {
            $user = new AccountActivation($token);
        } 
        catch (InvalidParamException $e) 
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($user->activateAccount()) 
        {
            Yii::$app->getSession()->setFlash('success', 
                Yii::t('app', 'Success! You can now log in.').' '.
                Yii::t('app', 'Thank you').' '.Html::encode($user->username).' '.
                Yii::t('app', 'for joining us!'));
        }
        else
        {
            Yii::$app->getSession()->setFlash('error', 
                Html::encode($user->username).
                Yii::t('app', 'your account could not be activated, please contact us!'));
        }

        return $this->redirect('login');
    }
     public function actionTable_selection()
    {
        $booking_time = ArrayHelper::map(BookingSearch::findAllbds(), 'booking_id','booking_time');
        $tables = ArrayHelper::map(TableSearch::findAllIds(), 'table_id', 'table_id');
        $date = ArrayHelper::map(BookingSearch::findAllbds(), 'booking_id','date');
        $model = new FilterForm();
        return $this->render('table_selection', [
                'model' => $model,
                'booking_time' => $booking_time,
                'date' => $date,
                'tables' => $tables,
            ]);
    }
    
    public function actionBooking_confirmation()
    {
        return $this->render('booking_confirmation');
    }
    public function actionContact_details()
    {
        $model = new Form();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {

        }else{
            return $this->render('contact_details', ['model' => $model]);
        }    

    }
}
