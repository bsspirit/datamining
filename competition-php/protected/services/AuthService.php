<?php 

class AuthService{
	
	public static function assign($uid,$type='player'){
		if(!empty($uid) && !empty($type)){
			$auth=Yii::app()->authManager;
			
			if(!$auth->isAssigned($type,$uid))
				$auth->assign($type,$uid);
		}
	}

	public static function revoke($uid,$type){
		if(!empty($uid) && !empty($type)){
			$auth=Yii::app()->authManager;

			if($auth->isAssigned($type,$uid))
				$auth->revoke($type,$uid);
		}
	}
}
?>