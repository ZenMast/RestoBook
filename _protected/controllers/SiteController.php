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
use app\models\UserSearch;
use app\models\TableSelection;
use app\models\BookingSearch;
use app\models\FilterForm;
use app\models\Reservation;
use app\models\Booking;
use Yii;
use app\models\Restaurant;
use app\models\app\models;
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
    	$model = new FilterForm();
    	$restaurants = RestaurantSearch::findAllData([]);    	
    	if ($model->load(Yii::$app->request->post())){
    		$selected_restaurants = RestaurantSearch::findFiltered($model); 
    	}
    	else {
    		$selected_restaurants = $restaurants;  		
    	}  
    	return $this->render('index', [
    			'restaurants' => $restaurants,
    			'selected_restaurants' => $selected_restaurants,
    			'model' => $model,
    	]);

        
    }

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

        $model = new LoginForm();
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
                    User '.Html::encode($user->email).' could not sign up.
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
                Yii::t('app', 'Hello').' '.Html::encode($user->email). '. ' .
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
                User '.Html::encode($user->email).' could not sign up.
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
                Yii::t('app', 'Thank you').' '.Html::encode($user->email).' '.
                Yii::t('app', 'for joining us!'));
        }
        else
        {
            Yii::$app->getSession()->setFlash('error', 
                Html::encode($user->email).
                Yii::t('app', 'your account could not be activated, please contact us!'));
        }

        return $this->redirect('login');
    }
    
    public function actionTable_selection()
    {
  
        $model = new Reservation();
        if ($model->load(Yii::$app->request->get()))
        {
	       	$tables = TableSearch::findAllTablesByRestId($model->restaurant_id);
	        $restaurant_data = RestaurantSearch::findAll(['restaurant_id'=>$model->restaurant_id]);
	    	return $this->render('table_selection', [
	    			'model' => $model,
	                'tables' => $tables,
	    			'restaurant_data'=>$restaurant_data,   			
	    	]);}
    }    
    
     public function actionBooking_confirmation()
    {

        $model = new Reservation();
        $model->load(Yii::$app->request->post());      
        return $this->render('booking_confirmation', [
                'model' => $model
        ]);
    }
       public function actionCreate_booking()
    {

        $model = new Booking();
        $request = Yii::$app->request;
        //$model->table_id = $request->post('Reservation[tables]'); 
        $model->user_id = Yii::$app->user->id;
        $model->table_id  = $_POST['Reservation']['tables'];
        $model->people  = $_POST['Reservation']['people'];
        $model->date  = $_POST['Reservation']['date'];
        $model->time  = $_POST['Reservation']['time'];
        $model->save();
        //print_r( $model);
        return $this->render('booking_finish', [
                    'model' => $model                   
         ]); 
        
    }
    public function actionContact_details()
    {          
        $model = new Reservation(); 
        $model->load(Yii::$app->request->post());
        if (!Yii::$app->user->isGuest)
        {
            if ($user = Yii::$app->user->identity) {
            $model->name = $user->name;
            $model->email = $user->email;
            $model->phone = $user->phone;
            }
            
            //print("Your table".Yii::$app->request->bodyParams);
            //print("Your id is ".Yii::$app->user->id);
            //print("Your name ".Yii::$app->user->identity->name);
            //print("Your email ".Yii::$app->user->identity->email);

             return $this->render('contact_details', [
                'model' => $model
        ]); 
        }
        else{
            return $this->render('contact_details', [
                'model' => $model
        ]);
        }
    } 
    
}