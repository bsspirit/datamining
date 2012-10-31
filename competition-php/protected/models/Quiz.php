<?php

/**
 * This is the model class for table "t_quiz".
 *
 * The followings are the available columns in table 't_quiz':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $create_date
 * @property string $end_date
 * @property integer $owner_id
 * @property integer $category
 */
class Quiz extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Quiz the static model class
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
		return 't_quiz';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, owner_id', 'required'),
			array('owner_id, category', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>16),
			array('content, create_date, end_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, content, create_date, end_date, owner_id, category', 'safe', 'on'=>'search'),
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
			'content' => 'Content',
			'create_date' => 'CreateDate',
			'end_date' => 'EndDate',
			'owner_id' => 'Owner',
			'category' => 'Category',
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
		$criteria->compare('content',$this->content,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('owner_id',$this->owner_id);
		$criteria->compare('category',$this->category);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function mappingCategory($category){
		$label='';
		switch($category){
			case 1:
				$label='Algorithm';
				break;
			case 2:
				$label='Classification';
				break;
			case 3:
				$label='Regression';
				break;
		}
		return $label;
	}
	public static function dropDownCategory($category){
		if(empty($category)) $category=1;
		$c1='';
		$c2='';
		$c3='';
		
		switch($category){
			case 1:$c1='SELECTED';break;
			case 2:$c2='SELECTED';break;
			case 3:$c3='SELECTED';break;
		}
		
		$html='<select name="Quiz[category]">';
		$html.='<option value="1" '.$c1.'>Algorithm</option>';
		$html.='<option value="2" '.$c2.'>Classification</option>';
		$html.='<option value="3" '.$c3.'>Regression</option>';
		$html.='</select>';
		
		return $html;
	}

}