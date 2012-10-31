<?php

class AdminController extends Controller
{
	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
					'actions'=>array('index',//后台管理
							'user','hidden','recover',//用户管理，屏蔽，恢复
							'role','assign','revoke',//角色权限管理，授权，取消授权
							'quiz','pass','reject','delete'),//题目管理，通过，拒绝，删除
					'roles'=>array('admin'),
			),
			array('deny',
					'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex(){
		$this->render('index');
	}
	
	//Role=========================================
	public function actionRole(){
		$dataProvider=new CActiveDataProvider('VUserRole');
		$this->render('role',array(
				'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionAssign(){
		AuthService::assign($_GET['uid'], $_GET['type']);
		echo 1;
	}
	
	public function actionRevoke(){
		AuthService::revoke($_GET['uid'], $_GET['type']);
		echo 1;
	}
	
	//Quiz=========================================
	public function actionQuiz(){
		//查类别
		$condition= '1=1';
		if(isset($_GET['category']))
			$condition.= ' AND category=' . $_GET['category'];
		if(isset($_GET['status']))
			$condition.= " AND status='" . $_GET['status']."'";
		
		$dataProvider=new CActiveDataProvider('VQuizBasic',array(
			'criteria' => array(
					'condition' => $condition,
			),
		));
		$this->render('quiz',array(
				'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionPass(){
		if(isset($_GET['qid'])){
			$quizStatus=$this->loadQuizStatus($_GET['qid']);
			$quizStatus->status='PASS';
			$quizStatus->save();
		}
		echo 1;
	}
	
	public function actionReject(){
		if(isset($_GET['qid'])){
			$quizStatus=$this->loadQuizStatus($_GET['qid']);
			$quizStatus->status='REJECT';
 			$quizStatus->save();
		}
		echo 1;
	}
	
	public function actionDelete(){
		if(isset($_GET['qid'])){
			$quizStatus=$this->loadQuizStatus($_GET['qid']);
			$quizStatus->status='DELETE';
			$quizStatus->save();
		}
		echo 1;
	}
	
	//util===============================================================
	public function loadQuizStatus($id){
		$model=QuizStatus::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}