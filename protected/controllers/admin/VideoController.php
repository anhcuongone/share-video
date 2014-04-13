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
		$model=Video::model()->findAll($criteria);
		echo CJSON::encode($model);
	}
}