<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

//use \yii\web\Request;
//$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());
return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            //'baseUrl' => $baseUrl,
            'class' => 'common\components\Request',
            'web' => '/frontend/web'
        ],
        'urlManager' => [
            //'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/index',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                'article/category/<cate:\w+>' => 'article/category',
                '<controller:\w+>/<action:\w+>/<tag:\w+>' => '<controller>/<action>',



            //'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>/<id:\d+>',
            // '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
            // '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=captainblog',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix'=>'cp_'
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
    ],
    'bootstrap' => ['gii'],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
        ],
        'backend' => [
            'class' => 'app\modules\backend',
        ],
    ],
    'params' => $params,
];
