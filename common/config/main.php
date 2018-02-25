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
	        'loginUrl' => ['rbac/user/login'],
        ],
	    /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],*/
    ],
    'modules' => [
	    'rbac' => [
		    'class' => 'mdm\admin\Module',
		    'controllerMap' => [
			    'assignment' => [
				    'class' => 'mdm\admin\controllers\AssignmentController',
				    /* 'userClassName' => 'app\models\User', */
				    'idField' => 'id',
				    'usernameField' => 'username',
//				    'fullnameField' => 'profile.full_name',
		        ],
            ],
		    'layout' => 'left-menu',
		    'mainLayout' => '@app/views/layouts/main.php',
        ],
    ],
    'as access' => [
	    'class' => 'mdm\admin\components\AccessControl',
	    'allowActions' => [
		    'site/*',
		    'gii/*',
		    'debug/*',
//		    '*'
	    ],
    ],
];
