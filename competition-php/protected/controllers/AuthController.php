<?php

class AuthController extends Controller {
	
	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions'=>array('init','clear'),//出始化角色，清空角色，授权，取消授权
				'users'=>array('admin'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}
	
	public function actionInit(){
		$auth=Yii::app()->authManager;
		
		//operation
		$auth->createOperation('createProblem','create a problem');
		$auth->createOperation('submitCode','submit a code for one problem');
		
		//task
		$bizRule='return Yii::app()->user->id==$params["post"]->authID;';
		$task=$auth->createTask('problems','problems task',$bizRule);
		$task->addChild('createProblem');
		
		$task=$auth->createTask('codes','codes task',$bizRule);
		$task->addChild('submitCode');
		
		//roles
		$role=$auth->createRole('owner');
		$role->addChild('problems');
		
		$role=$auth->createRole('player');
		$role->addChild('codes');
		
		$role=$auth->createRole('admin');
		$role->addChild('owner');
		$role->addChild('player');
		
		//assgin
		$auth->assign('admin','1');
		$auth->assign('owner','2');
		$auth->assign('player','3');
	}
	
	public function actionClear(){
		$auth=Yii::app()->authManager;
		$auth->clearAll();
	}
}