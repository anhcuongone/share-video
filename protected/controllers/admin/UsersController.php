<?php

class UsersController extends Controller
{
	//public $layout='/';

	public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
           array('deny',
                'actions'=>array('index'),
                'users'=>array('?'),
            ),
            array('allow',
                'actions'=>array('delete'),
                'roles'=>array('admin'),
            ),
            array('deny',
                'actions'=>array('delete'),
                'users'=>array('*'),
            ),
        );
    }

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actiongetAll()
    {
        $user=new CDbCriteria;
        $model=  User::model()->findAll($user);       
        echo CJSON::encode($model); 
    }

    public function actionlogin()
    {
    	if (isset($_POST["submit"])) {
    		$username=$_POST["username"];
    		$password=$_POST["password"];
    		$identity=new UserIdentity($username,$password);

			if($identity->authenticate())
			{
		    	Yii::app()->user->login($identity);
			}
			else
		   		echo $identity->errorMessage;
    	}
    	
    	$this->render('login');
    }
	public function actionlogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}