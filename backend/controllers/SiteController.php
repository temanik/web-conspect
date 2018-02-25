<?php
namespace backend\controllers;

use Yii;
use yii\rbac\DbManager;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//	        'access' => [
//		        'class' => AccessControl::className(),
//		        'except' => ['login'],
//		        'rules' => [
//			        [
//			        	'allow' => true,
//				        'roles' => ['user'],
//				        'denyCallback' => function($rule, $action) {
//					        Yii::$app->session->setFlash('info', 'Сообщение о переадресации');
//					        Yii::$app->user->logout();
//				        },
//			        ]
//		        ],
//	        ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
//        ];
//    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
    	$this->layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
	        $user = new DbManager;
	        $roles = $user->getRolesByUser(Yii::$app->user->id);
	        if(isset($roles['user'])){
		        Yii::$app->user->logout();
		        Yii::$app->session->setFlash('error', 'Вам сюда нельзя! К данному разделу имеют доступ только администраторы.');
	        }
        	return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
