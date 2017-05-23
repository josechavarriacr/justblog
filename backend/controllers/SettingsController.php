<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use  yii\helpers\FileHelper;

class SettingsController extends Controller
{
	
	public function behaviors()
	{	
		return [
		'access' => [
		'class' => AccessControl::className(),
		'rules' => [
		[
        'actions' => ['login', 'error'],//actions without loggin
        'allow' => true,
        ],
        [
        'actions' => ['flush-cache','clear-assets','settings'],//action with login
        'allow' => true,
        'roles' => ['@'],
        ],
        ]
        ],
        'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
        'flush-cache' => ['POST'],
        'clear-assets' => ['POST'],
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
    	];
    }

     public function actionSettings()
    {
        return $this->render('settings');
    }

    public function actionFlushCache()
    {
    	Yii::$app->cache->flush();
    	Yii::$app->session->addFlash('success', 'Cache flushed.');
    	return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionClearAssets()
    {	
    	$fron = Yii::getAlias('@frontend/web/assets');
    	$back = Yii::$app->assetManager->basePath;

    	$this->Clean($fron);
    	$this->Clean($back);
    	Yii::$app->session->addFlash('success', 'Assets flushed.');

    	return $this->redirect(Yii::$app->request->referrer);
    }

    private function Clean($path)
    {
    	foreach(glob($path. DIRECTORY_SEPARATOR . '*') as $asset){
    		Yii::$app->session->addFlash('info', $asset);
    		if(is_link($asset)){
    			unlink($asset);
    		} elseif(is_dir($asset)){
    			FileHelper::removeDirectory($asset);
    		} else {
    			unlink($asset);
    		}
    	}
    }
}
