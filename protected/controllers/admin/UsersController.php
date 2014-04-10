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
            // array('deny',
            //     'actions'=>array('index'),
            //     'users'=>array(''),
            //     'message'=>'Access Denied.',
            //     //'url'=>'',
            // ),

            // array('allow',
            //     'actions'=>array('delete'),
            //     'roles'=>array('admin'),
            //     'message'=>'Access Denied.',
            // ),
            // array('deny',
            //     'actions'=>array('delete','deleteAll'),
            //     'users'=>array('*'),
            //     'message'=>"You don't have permission for this action.",
            // ),
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
        $model=Yii::app()->db->createCommand()
                    ->select("u.*,r.role_name")
                    ->from("users u")
                    ->join("roles r","u.role = r.id")
                    ->order("id desc")
                    ->queryAll();    
        foreach ($model as $key=>$value) {
            if($value["active"]==0){
                $model[$key]["active"]="Inactive";
            }else{
                $model[$key]["active"]="Active";
            }
        }
      
        echo CJSON::encode($model); 
    }
    
    public function actionsearch()
    {
        $username='';
        if (isset($_GET["look"])) {
            $username=$_GET["look"];
        }
        $model=Yii::app()->db->createCommand()
                    ->select("u.*,r.role_name")
                    ->from("users u")
                    ->join("roles r","u.role = r.id")
                    ->where(array("like","username","%".$username."%"))
                    ->order("id desc")
                    ->queryAll();    
        foreach ($model as $key=>$value) {
            if($value["active"]==0){
                $model[$key]["active"]="Inactive";
            }else{
                $model[$key]["active"]="Active";
            }
        }
      
        echo CJSON::encode($model); 
    }

    public function actionlogin()
    {
        $this->layout='/';
        $model=new users;
        $error="";
        $duration=0;
        if (isset($_POST["submit"])) {
            $username=$_POST["username"];
            $password=$_POST["password"];
            $identity=new UserIdentity($username,$password);

            if(isset($_POST["remember"])){
                 $duration= 3600*24*30;
            }
           
            if($identity->authenticate()){
                Yii::app()->user->login($identity,$duration);
                $this->redirect($this->createUrl("admin/users/index"));
            }
            else{
                 if(!$identity->errorMessage){
                    $error="Incorrect username or password.";
                 }
            }
        }
        
        $this->render('login',array("model"=>$model,"error"=>$error));
    }
    public function actionlogout()
    {
        Yii::app()->user->logout();
        $this->redirect($this->createUrl("admin/users/login"));
    }

    public function actionadd()
    {       
        $user=new users;
        $error="";
        if (!$_POST["username"]) {
            $error="Username is not empty. <br/>";
        }

        if (!$_POST["password"]) {
            $error.="Password is not empty. <br/>";
        }

        if (!$_POST["confirmPassword"]) {
            $error.="Confirm password is not empty. <br/>";
        }

         if ($_POST["confirmPassword"] != $_POST["password"]) {
             echo "Confirm password is not equal. <br/>";
             exit();
         }

        if(isset($_POST['submit'])){
            $user->username=$_POST["username"];
            $user->password=crypt($_POST["password"],"21OZ4/WxREgV.");
            $user->role=$_POST["role"];
            $user->active=$_POST["active"];
            $user->created=date("Y-m-d H:i:s");
            $user->modified=date("Y-m-d H:i:s");
            if($user->validate() && $user->save()){
                echo "Save successfuly";
            }
            else{
                echo $error;
            }      
        }  
        //$this->renderPartial("index",array("user"=>$user),true);
    }

    public function actionedit()
    {
        $error="";
        $user=users::model()->findByPk($_POST["id"]);
        if (!$_POST["username"]) {
            $error="Username is not empty. <br/>";
        }
        if(isset($_POST['submit'])){
            $user->username=$_POST["username"];
            $user->role=$_POST["role"];
            $user->active=$_POST["active"];
            $user->modified=date("Y-m-d H:i:s");
            if($user->validate() && $user->save())
            {
                echo "Edit successfuly";
            }
            else{
                echo $error;
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