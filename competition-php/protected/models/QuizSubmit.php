<?php

/**
 * This is the model class for table "t_quiz_submit".
 *
 * The followings are the available columns in table 't_quiz_submit':
 * @property integer $id
 * @property integer $qid
 * @property string $lang
 * @property string $code
 * @property string $create_date
 * @property integer $player_id
 * @property integer $status
 * @property integer $result
 */
class QuizSubmit extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QuizSubmit the static model class
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
		return 't_quiz_submit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('qid, code, player_id', 'required'),
			array('qid, player_id, status, result', 'numerical', 'integerOnly'=>true),
			array('lang', 'length', 'max'=>16),
			array('create_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, qid, lang, code, create_date, player_id, status, result', 'safe', 'on'=>'search'),
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
			'lang' => 'Lang',
			'code' => 'Code',
			'create_date' => 'Create Date',
			'player_id' => 'Player',
			'status' => 'Status',
			'result' => 'Result',
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
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('player_id',$this->player_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('result',$this->result);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}