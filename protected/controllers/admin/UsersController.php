<?php

class UsersController extends Controller
{
	public $layout='admin';

	public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index'),
                'roles'=>array('admin'),
            ),
            array('deny',
                'actions'=>array(''),
                'users'=>array('*'),
            ),
        );
    }

	public function actionIndex()
	{
        $model = new CDbCriteria;
        $model->alias ="roles";
        $role=roles::model()->findAll($model);
		$this->render('index',array("role"=>$role));
	}

	public function actiongetAll()
    {
        $user=new CDbCriteria;
        $model=  Users::model()->findAll($user);  
        foreach ($model as $value) {
            if($value->active==0){
                $value->active="Inactive";
            }else{
                $value->active="Active";
            }
        }
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

    public function actionadd()
    {
        $user=new users;
       
        if(isset($_POST['submit'])){
            $user->username=$_POST["username"];
            $user->password=crypt($_POST["password"],"21OZ4/WxREgV.");
            $user->role=$_POST["role"];
            $user->active=$_POST["active"];
            $user->created=date("Y-m-d H:i:s");
            $user->modified=date("Y-m-d H:i:s");
            if($user->validate() && $user->save())
            {
                echo "Save successfuly";
            }
            else{
                echo "Save not successfuly";
            }
        }   
        //$this->render("add",array("user"=>$user));
    }

    public function actionedit()
    {
        $user=new users;
       
        if(isset($_POST['submit'])){
            $user->username=$_POST["username"];
            $user->password=crypt($_POST["password"],"21OZ4/WxREgV.");
            $user->role=$_POST["role"];
            $user->active=$_POST["active"];
            $user->modified=date("Y-m-d H:i:s");
            if($user->validate() && $user->save())
            {
                echo "Edit successfuly";
            }
            else{
                echo "Edit not successfuly";
            }
        }   
        //$this->render("add",array("user"=>$user));
    }
    public function actiondelete($id)
    {
        $model=Users::model()->findByPk($id);
        if($model->delete()){
            echo "Delete successfuly";
        }
        else{
            echo "Delete not successfuly";
        }
    }

    public function actiondeleteAll()
    {
        $recoder=0;
        $count=count($_POST["id"]);
        $data=$_POST["id"];
        foreach ($data as $value) {
            $model=Users::model()->findByPk($value);
            $recoder=$model->delete();
        }
        if ($recoder==1) {
            echo "Delete ".$count." record successfuly";
        }else{
             echo "Delete ".$count." record not successfuly";
        }
    }
}