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
 * @property integer $uid
 */
class Quiz extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function tableName()
	{
		return 't_quiz';
	}

	public function rules()
	{
		return array(
			array('title, content, uid', 'required'),
			array('uid', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>16),
			array('create_date, end_date', 'safe'),
			array('id, title, content, create_date, end_date, uid', 'safe', 'on'=>'search'),
		);
	}

	public function relations()//通过视图解决
	{
		return array(
// 			'user' => array(self::BELONGS_TO, 'User', 'id'),
				
// 			#SELECT if(sum(result),sum(result),0) as correct,count(id) as count FROM competition.t_quiz_submit where qid=1
// 			'correct'=>array(self::STAT, 'QuizSubmit','qid','select'=>'if(sum(result),sum(result),0) '),
// 			'count'=>array(self::STAT, 'QuizSubmit','qid','select'=>'count(1) '),
			
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => '标题',
			'content' => '内容',
			'create_date' => '创建时间',
			'end_date' => '结束时间',
			'uid' => '发布者',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('uid',$this->uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}