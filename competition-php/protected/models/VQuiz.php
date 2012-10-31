<?php

/**
 * This is the model class for table "v_quiz".
 *
 * The followings are the available columns in table 'v_quiz':
 * @property integer $id
 * @property string $title
 * @property string $create_date
 * @property integer $owner_id
 * @property string $owner_name
 * @property integer $category
 * @property string $currect
 * @property string $count
 */
class VQuiz extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VQuiz the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_quiz';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, owner_id, category', 'required'),
			array('id, owner_id, category', 'numerical', 'integerOnly'=>true),
			array('title, owner_name', 'length', 'max'=>16),
			array('currect, count', 'length', 'max'=>21),
			array('create_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, create_date, owner_id, owner_name, category, currect, count', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'title' => 'Title',
			'create_date' => 'Create Date',
			'owner_id' => 'Owner',
			'owner_name' => 'Owner Name',
			'category' => 'Category',
			'currect' => 'Currect',
			'count' => 'Count',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('owner_id',$this->owner_id);
		$criteria->compare('owner_name',$this->owner_name,true);
		$criteria->compare('category',$this->category);
		$criteria->compare('currect',$this->currect,true);
		$criteria->compare('count',$this->count,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}