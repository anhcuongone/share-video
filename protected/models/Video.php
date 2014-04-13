<?php

/**
 * This is the model class for table "video".
 *
 * The followings are the available columns in table 'video':
 * @property integer $video_id
 * @property integer $video_category_id
 * @property string $video_title
 * @property string $video_description
 * @property string $video_url
 * @property string $video_image
 * @property integer $video_total_view
 * @property string $video_date_create
 * @property integer $video_active
 */
class Video extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'video';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('video_category_id, video_title, video_description, video_url, video_image, video_total_view, video_date_create', 'required'),
			array('video_category_id, video_total_view, video_active', 'numerical', 'integerOnly'=>true),
			array('video_title, video_image', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('video_id, video_category_id, video_title, video_description, video_url, video_image, video_total_view, video_date_create, video_active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'video_id' => 'Video',
			'video_category_id' => 'Video Category',
			'video_title' => 'Video Title',
			'video_description' => 'Video Description',
			'video_url' => 'Video Url',
			'video_image' => 'Video Image',
			'video_total_view' => 'Video Total View',
			'video_date_create' => 'Video Date Create',
			'video_active' => 'Video Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('video_id',$this->video_id);
		$criteria->compare('video_category_id',$this->video_category_id);
		$criteria->compare('video_title',$this->video_title,true);
		$criteria->compare('video_description',$this->video_description,true);
		$criteria->compare('video_url',$this->video_url,true);
		$criteria->compare('video_image',$this->video_image,true);
		$criteria->compare('video_total_view',$this->video_total_view);
		$criteria->compare('video_date_create',$this->video_date_create,true);
		$criteria->compare('video_active',$this->video_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Video the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
