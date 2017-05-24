<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Post;
use frontend\models\PostSearch;
use yii\data\Pagination;
use frontend\components\Analytics;
use backend\models\Profile;
use backend\models\Metatag;

class SiteController extends Controller
{
	public function behaviors()
	{
		return [
		'access' => [
		'class' => AccessControl::className(),
		'only' => ['logout', 'signup','index','contact','about'],
		'rules' => [
		[
        'actions' => ['signup','index'],//allows without login
        'allow' => true,
        'roles' => ['?'],
        ],
        [
        'actions' => ['logout'], //allow with login
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
    	];
    }

    public function actionIndex()
    {
    	$query = Post::find()->orderBy(['created_at'=>SORT_DESC]);
    	$countQuery = clone $query;
    	$pages = new Pagination(['totalCount' => $countQuery->count()]);
    	
    	$models = $query->offset($pages->offset)
    	->limit($pages->limit)
    	->all();

    	return $this->render('index',[
    		'models' => $models,
    		'pages' => $pages,]);
    }

    protected function findModel($id)
    {
    	if (($model = Post::findOne($id)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }

    public function actionLogin()
    {
    	if (!Yii::$app->user->isGuest) {
    		return $this->goHome();
    	}

    	$model = new LoginForm();
    	if ($model->load(Yii::$app->request->post()) && $model->login()) {
    		return $this->goBack();
    	} else {
    		return $this->render('login', [
    			'model' => $model,
    			]);
    	}
    }

    public function actionLogout()
    {
    	Yii::$app->user->logout();

    	return $this->goHome();
    }

    public function actionContact()
    {
    	$model = new ContactForm();
    	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    		if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
    			Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
    		} else {
    			Yii::$app->session->setFlash('error', 'There was an error sending email.');
    		}

    		return $this->refresh();
    	} else {
    		return $this->render('contact', [
    			'model' => $model,
    			]);
    	}
    }

    public function actionAbout(){
    	return $this->render('about');
    }

    public function actionPrivacy(){
        return $this->render('privacy');
    }

    public function actionSignup()
    {
    	$model = new SignupForm();
    	if ($model->load(Yii::$app->request->post())) {
    		if ($user = $model->signup()) {

    			$profile = new Profile();
    			$profile->id_user = $user->id;
    			$profile->email = $user->email;
    			$profile->save(false);

    			$meta = new Metatag();
    			$meta->id_user = $user->id;
    			$meta->save(false);
    			
    			if (Yii::$app->getUser()->login($user)) {
    				return $this->goHome();
    			}
    		}
    	}

    	return $this->render('signup', [
    		'model' => $model,
    		]);
    }

    public function actionRequestPasswordReset()
    {
    	$model = new PasswordResetRequestForm();
    	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    		if ($model->sendEmail()) {
    			Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

    			return $this->goHome();
    		} else {
    			Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
    		}
    	}

    	return $this->render('requestPasswordResetToken', [
    		'model' => $model,
    		]);
    }

    public function actionResetPassword($token)
    {
    	try {
    		$model = new ResetPasswordForm($token);
    	} catch (InvalidParamException $e) {
    		throw new BadRequestHttpException($e->getMessage());
    	}

    	if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
    		Yii::$app->session->setFlash('success', 'New password was saved.');

    		return $this->goHome();
    	}

    	return $this->render('resetPassword', [
    		'model' => $model,
    		]);
    }
}
