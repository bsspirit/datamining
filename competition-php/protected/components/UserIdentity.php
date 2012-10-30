<?php
class UserIdentity extends CUserIdentity {
	private $_id;
	
	public function authenticate(){
		$record=User::model()->findByAttributes(array('name'=>$this->name));
		if($record===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($record->password!==md5($this->password))//else if($record->password!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$record->id;
			$this->setState('title', $record->title);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	
	public function getId()	{
		return $this->_id;
	}
}