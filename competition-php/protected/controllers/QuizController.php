<?php

class QuizController extends Controller
{
	public $layout='//layouts/column1';
	
	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
					'actions'=>array('index','view'),//浏览列表，查看详细
					'users'=>array('*'),
			),
			array('allow',
					'actions'=>array('download','status'),//下载测试数据，查看题目状态
					'users'=>array('@'),
			),
			array('allow',
					"actions"=>array('submit','player','source'),//提交代码，我已完成的题目,源代码
					'roles'=>array('player'),
			),
			array('allow',
					"actions"=>array('create','update','owner'),//创建新题，我已发布的题目
					'roles'=>array('owner'),
			),
			array('allow',
					'actions'=>array('delete'),//删除题目
					'roles'=>array('admin'),
			),
			array('deny',
					'users'=>array('*'),
			),
		);
	}

	//所有人===============================================================
	public function actionIndex(){
		//查类别
		$condition='';
		if(isset($_GET['category']))
			$condition.= ' category=' . $_GET['category'];
		
		$dataProvider=new CActiveDataProvider('VQuiz',array(
				'criteria' => array(
						'condition' => $condition,
				),
				'pagination'=>array(
						'pageSize'=>50,
				),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionView($id){
		$quizData = QuizService::getQuizTrainSet($id);
		$this->render('view',array(
				'model'=>$this->loadModel($id),
				'train'=>$quizData,
		));
	}
	
	//登陆用户===============================================================
	public function actionStatus(){
		//查类别
		$condition='';
		if(isset($_GET['category']))
			$condition.= ' category=' . $_GET['category'];
		if(isset($_GET['qid']))
			$condition.= ' qid=' . $_GET['qid'];
		
		$dataProvider=new CActiveDataProvider('VQuizStatus',array(
				'criteria' => array(
						'condition' => $condition,
				),
				'pagination'=>array(
						'pageSize'=>50,
				),
				'sort'=>array(
						'defaultOrder'=>'id DESC',
				),
		));
		
		$this->render('status',array(
				'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionDownload(){
		
	}

	//player===============================================================
	public function actionPlayer(){
		
		//查类别
		$condition='player_id='.Yii::app()->user->id;
		if(isset($_GET['category']))
			$condition.= ' AND category=' . $_GET['category'];
		
		$dataProvider=new CActiveDataProvider('VQuizStatus',array(
				'criteria' => array(
						'condition' => $condition,
				),
				'pagination'=>array(
						'pageSize'=>50,
				),
				'sort'=>array(
						'defaultOrder'=>'id DESC',
				),
		));
		
		$this->render('player',array(
				'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionSubmit(){
		$submit=new QuizSubmit;
		$submit->qid=empty($_REQUEST["qid"])?'':$_REQUEST["qid"];
		$submit->player_id=Yii::app()->user->id;
		
		$this->performAjaxValidation($submit);
		if(isset($_POST['QuizSubmit'])) {
			$submit->attributes=$_POST['QuizSubmit'];
			if($submit->save()){//INIT
				
				$url = 'http://api.freemined.com/api/quiz/'.$submit->player_id.'/'.$submit->id;
				HttpService::get($url);
				
// 				$rpath = 'D:/workspace/datamining/competition/r/';
// 				$script='Rscript --vanilla '.$rpath.'test.R ' . $submit->id .' ' . $submit->player_id;
// 				echo system($script);
				
 				$this->redirect('/quiz/player');
			}
		}
		
		$this->render('submit',array(
			'model'=>$submit,
		));
	}
	
	public function actionSource($id){
		$submit=QuizSubmit::model()->findByPk($id);
		
		if($submit===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		if($submit->player_id != Yii::app()->user->id)
			throw new CHttpException(400,'You can\'t view others source!!');
		
		$this->render('source',array(
				'model'=>$submit,
		));
	}

	//owner===============================================================
	public function actionOwner(){
		
		//查类别
		$condition='owner_id='.Yii::app()->user->id;
		if(isset($_GET['category']))
			$condition.= ' AND category=' . $_GET['category'];
		if(isset($_GET['status']))
			$condition.= " AND status='" . $_GET['status']."'";
		
		$dataProvider=new CActiveDataProvider('VQuizBasic',array(
				'criteria' => array(
						'condition' => $condition,
				),
				'pagination'=>array(
						'pageSize'=>50,
				),
				'sort'=>array(
						'defaultOrder'=>'id DESC',
				),
		));
		
		$this->render('owner',array(
				'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionCreate(){
		$quiz=new Quiz;
		$quiz->owner_id=Yii::app()->user->id;
//  		$this->performAjaxValidation($quiz);

		if(isset($_POST['Quiz'])) {
			$quiz->attributes=$_POST['Quiz'];
			if(isset($_POST['content']))
				$quiz->content=$_POST['content'];
			
			if($quiz->save()){
				$qid=$quiz->id;
				$quizStatus=new QuizStatus;
				$quizStatus->qid=$qid;
				
				if($quizStatus->save()){
					QuizService::uploadDataSet($qid);
					$this->redirect(array('view','id'=>$qid));
				}
			}
		}	
		
		$this->render('create',array(
				'model'=>$quiz,
		));
	}
	
	public function actionUpdate($id)	{
		$model=$this->loadModel($id);
		$this->performAjaxValidation($model);
		
		$train=QuizService::getDataSet($id, 0);
		$test=QuizService::getDataSet($id, 1);
		$result=QuizService::getDataSet($id, 2);
		
		if(isset($_POST['Quiz']))		{
			$model->attributes=$_POST['Quiz'];
			if(isset($_POST['content']))
				$model->content=$_POST['content'];
			
			if($model->save()){
				QuizService::uploadDataSet($id);
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
				'model'=>$model,
				'train'=>$train,
				'test'=>$test,
				'result'=>$result,
		));
	}

	
	//admin===============================================================
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}


	//util===============================================================
	public function loadModel($id){
		$model=Quiz::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='quiz-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
}
