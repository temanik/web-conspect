<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'ru-RU',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
	    'urlManager' => [
		    'enablePrettyUrl' => true,
		    'showScriptName' => false,
	    ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
	        'class' => 'yii\rbac\DbManager',
        ],
        'user' => [
	        'identityClass' => 'mdm\admin\models\User',
	        'loginUrl' => ['/site/login'],
        ],
	    /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],*/
    ],
    'as access' => [
	    'class' => 'mdm\admin\components\AccessControl',
	    'allowActions' => [
//		    'login/*',
		    'site/signup',
		    'site/login',
		    'site/logout',
		    'debug/*',
//		    '*'
	    ],
    ],
];
