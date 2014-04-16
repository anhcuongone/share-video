<?php

class VideoController extends Controller
{
	public $layout="admin";

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actiongetAll()
	{
		$criteria= new CDbCriteria();
		$criteria->order= "video_id DESC";
		$model=Video::model()->findAll($criteria);
		echo CJSON::encode($model);
	}

	public function actionsearch()
	{
		$video_title='';
		$category_id='';
		if (isset($_GET["look"])) {
           	$video_title=$_GET["look"];
			$category_id=$_GET["look"];
        }
		
		$query=Yii::app()->db->createCommand()
					->select("*")
					->from("video")
					->where(array("like","video_title","%".$video_title."%"))
					->orwhere("video_category_id= :category_id",array(":category_id"=>$category_id))
					->order("video_id DESC")
					->queryAll()
					;
		echo CJSON::encode($query);
	}

	public function actiondeleteAll()
	{
		$recoder=0;
        $count=1;
		$data=$_POST['id'];
		foreach ($data as $item) {
			$count++;
			$model=Video::model()->findByPk($item);
			$recoder=$model->delete();
		}
		if ($recoder==1) {
			echo "Delete ".$count." record successfuly";
        }else{
             echo "Delete ".$count." record not successfuly";
        }
	}
}