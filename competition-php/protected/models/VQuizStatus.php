<?php

/**
 * This is the model class for table "v_quiz_status".
 *
 * The followings are the available columns in table 'v_quiz_status':
 * @property integer $id
 * @property integer $qid
 * @property string $title
 * @property string $create_date
 * @property string $lang
 * @property integer $status
 * @property integer $result
 * @property integer $player_id
 * @property string $player_name
 * @property string $code_length
 */
class VQuizStatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VQuizStatus the static model class
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
		return 'v_quiz_status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('qid, player_id', 'required'),
			array('id, qid, status, result, player_id', 'numerical', 'integerOnly'=>true),
			array('title, lang', 'length', 'max'=>16),
			array('player_name', 'length', 'max'=>128),
			array('code_length', 'length', 'max'=>10),
			array('create_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, qid, title, create_date, lang, status, result, player_id, player_name, code_length', 'safe', 'on'=>'search'),
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
			'qid' => 'Qid',
			'title' => 'Title',
			'create_date' => 'Create Date',
			'lang' => 'Lang',
			'status' => 'Status',
			'result' => 'Result',
			'player_id' => 'Player',
			'player_name' => 'Player Name',
			'code_length' => 'Code Length',
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
		$criteria->compare('qid',$this->qid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('result',$this->result);
		$criteria->compare('player_id',$this->player_id);
		$criteria->compare('player_name',$this->player_name,true);
		$criteria->compare('code_length',$this->code_length,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}