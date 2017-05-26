<?php
use \yii\web\Request;

// $baseUrl = str_replace('/backend/web', '', (new Request)->getBaseUrl());
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/uploads',
            'uploadUrl' => '@web/uploads',
            'imageAllowExtensions'=>['jpg','png','gif']
                    ],
                ],
    'components' => [
        'as beforeRequest' => [
            'class' => 'yii\filters\AccessControl',
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['login'],
                ],
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        'denyCallback' => function () {
          return Yii::$app->response->redirect(['site/login']);
                                   },
            ],
    	// 'request' => [
     //        'baseUrl' => $baseUrl,
     //    ],
        // 'request' => [
        //     'csrfParam' => '_csrf-backend',
        // ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'site' => [
            'class' => 'frontend\components\MetaTagsSite',
        ],
        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                '<action:(contact|login|signup|logout|index|settings)>'=>'site/<action>', //hide site directory

                'post' => 'post/index',
                'post/index' => 'post/index',
                'post/create' => 'post/create',
                'post/list' => 'post/list',
                'post/view/<id:\d+>' => 'post/view',  
                'post/view/<id:\d+>' => 'post/view',  
                'post/update/<id:\d+>' => 'post/update',  
                'post/delete/<id:\d+>' => 'post/delete',  
                'post/<url>' => 'post/url',
                
                '<controller:\w+>/<id:\d+>' => '<controller>/view',//hide view action
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        
    ],
    'params' => $params,
];
