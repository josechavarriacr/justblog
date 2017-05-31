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
// use frontend\components\Analytics;
use yii\data\Pagination;
use backend\models\Profile;
use backend\models\Metatag;
use kartik\growl\Growl;

class SiteController extends Controller
{
	public function behaviors()
	{
        // Analytics::init();
		return [
		'access' => [
		'class' => AccessControl::className(),
		'only' => ['logout', 'signup','requestPasswordReset','resetPassword','contact'],
		'rules' => [
		[
        'actions' => ['signup'],//allows without login
        'allow' => false, //true for use singup
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
    	$profile = Profile::find()->orderBy('id ASC')->limit(1)->one();
    	if (!is_null($profile)) {
    		Growl::widget([
    			'type' => Growl::TYPE_GROWL,
    			'title' => 'Ups!',
    			'icon' => "$profile->image",
    			'iconOptions' => ['class'=>'img-ico'],
    			'body' => '</br>Try again.',
    			'showSeparator' => false,
    			'delay' => 0,
    			'pluginOptions' => [
    			'icon_type'=>'image',
    			'showProgressbar' => false,
    			'placement' => [
    			'from' => 'top',
    			'align' => 'right',
    			],
    			]
    			]);
    	}
    	return $this->render('index');
    }

    public function actionAdmin()
    {
    	$profile = Profile::find()->orderBy('id ASC')->limit(1)->one();
    	if (!is_null($profile)) {
    		Growl::widget([
    			'type' => Growl::TYPE_GROWL,
    			'title' => 'Ups!',
    			'icon' => "$profile->image",
    			'iconOptions' => ['class'=>'img-ico'],
    			'body' => '</br>Try again.',
    			'showSeparator' => false,
    			'delay' => 0,
    			'pluginOptions' => [
    			'icon_type'=>'image',
    			'showProgressbar' => false,
    			'placement' => [
    			'from' => 'top',
    			'align' => 'right',
    			],
    			]
    			]);
    	}
    	return $this->render('index');
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
      $model = Post::find()->where(['type'=>'about'])->andWhere(['status'=>1])
      ->orderBy(['id'=>SORT_ASC])->limit(1)->one();

      return $this->render('about', [
        'model' => $model,
        ]);
    }

    public function actionPrivacy(){
      $model = Post::find()->where(['type'=>'privacy'])->andWhere(['status'=>1])
      ->orderBy(['id'=>SORT_ASC])->limit(1)->one();

      return $this->render('privacy',[
        'model' => $model,
        ]);
    }

    public function actionMe(){
     $model = Profile::find()->orderBy(['id'=>SORT_ASC])->limit(1)->one();

     return $this->render('me',[
      'model' => $model,
      ]);
   }

   public function actionAma(){
     $model = Post::find()->where(['type'=>'ama'])->andWhere(['status'=>1])
     ->orderBy(['id'=>SORT_ASC])->limit(1)->one();

     return $this->render('ama',[
      'model' => $model,
      ]);
   }

   public function actionWpAdmin(){
     $profile = Profile::find()->orderBy('id ASC')->limit(1)->one();
     if (!is_null($profile)) {
      Growl::widget([
       'type' => Growl::TYPE_GROWL,
       'title' => 'Nope!',
       'icon' => "$profile->image",
       'iconOptions' => ['class'=>'img-ico'],
       'body' => '</br>Esto no es un WordPress.',
       'showSeparator' => false,
       'delay' => 0,
       'pluginOptions' => [
       'icon_type'=>'image',
       'showProgressbar' => false,
       'placement' => [
       'from' => 'top',
       'align' => 'right',
       ],
       ]
       ]);
    }else{
      Yii::$app->session->setFlash('info','Esto no es un WordPress');
    }
    return $this->render('about');
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
