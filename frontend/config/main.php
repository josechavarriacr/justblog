<?php
use \yii\web\Request;

$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' =>'es',
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'social' => [
            'class' => 'kartik\social\Module',
                'disqus' => [
                    'settings' => ['shortname' => 'DISQUS_SHORTNAME'] // default settings
                        ],
                    ],
                ],
    'components' => [
        'request' => [
            'baseUrl' => $baseUrl,
        ],
        // 'request' => [
        //     'csrfParam' => '_csrf-frontend',
        // ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'sc' => [
            'class' => 'frontend\components\SrcCollect',
        ],
        'meta' => [
            'class' => 'frontend\components\MetaTagsPost',
        ],
        'site' => [
            'class' => 'frontend\components\MetaTagsSite',
        ],
        'urlManager' => [
        'class' => 'yii\web\UrlManager',
        'showScriptName' => false,
        'enablePrettyUrl' => true,
        'rules' => array(
            
                '<action:(contact|login|signup|logout|index|privacy|wp-admin|admin|about|me|ama)>'=>'site/<action>', //hide site directory
                '<action:(rss)>' => 'post/<action>',//hide post directory

                'post' => 'post/index',
                'post/index' => 'post/index',
                'post/create' => 'post/create',
                'post/view/<id:\d+>' => 'post/view', 
                'post/update/<id:\d+>' => 'post/update',  
                'post/delete/<id:\d+>' => 'post/delete',  
                'post/<url>' => 'post/url',

                 
                '<controller:\w+>/<id:\d+>' => '<controller>/view',//hide action ?view=
                // '<controller:\w+>/<action:\w+>/<tag>' => '<controller>/<action>',//hide action ?tag=
                '<controller:\w+>/<action:\w+>/<category>' => '<controller>/<action>',//hide action ?category=
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        ),
        ],
    ],
    'params' => $params,
];
