<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
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
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl'=>'/admin',
        ],
        'user' => [
	        'identityClass' => 'mdm\admin\models\User',
	        'loginUrl' => ['/site/login'],
        ],
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],*/
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
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
    'params' => $params,
];
