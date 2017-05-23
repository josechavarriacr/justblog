<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\Logs;

class AnalyticsController extends Controller
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
        'actions' => ['charts'],//action with login
        'allow' => true,
        'roles' => ['@'],
        ],
        ]
        ],
        'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
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

    public function actionCharts()
    {
        $visits = Logs::getVisits();
        $name = Logs::getNames();
        $categories = Logs::getCategories();
        $browser = Logs::getBrowser();
        $referrer = Logs::getReferrer();
        $language = Logs::getLanguage();
        $os = Logs::getOS();
        $device = Logs::getDevice();
        $type = Logs::getType();
        $new = Logs::getNew();

        return $this->render('charts', [
            'visits' => $visits,
            'name' => $name,
            'categories' => $categories,
            'browser' => $browser,
            'referrer' => $referrer,
            'language' => $language,
            'os' => $os,
            'device' => $device,
            'type' => $type,
            'new' => $new,
            ]);
    }
}
